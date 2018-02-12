<?php


namespace frontend\widgets\forms;

use common\models\ckm\Vacancy;
use common\models\ckm\VacancyLang;
use common\models\ckm\VacancyMessage;
use common\models\ckm\VacancyMessageEducation;
use common\models\ckm\VacancyMessageJobs;
use yii\base\Widget;
use Yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\db\Exception;
use frontend\widgets\models\MyModel;
use yii\web\UploadedFile;

class VacancyFormWidget extends Widget
{


        public function init(){

        }

        public function run() {

            //$vacancies= Vacancy::find()->all();

            $vacancies = ArrayHelper::map(VacancyLang::find()
                                                ->where(['lang' => Yii::$app->language])
                                                ->andWhere(['IS NOT', 'title', null])
                                                ->all(), 'item_id', 'title');



            $modelMain = new VacancyMessage;
            $modelEducation = [
                new VacancyMessageEducation
            ];
            $modelJob = [
                new VacancyMessageJobs
            ];

            if ($modelMain->load(Yii::$app->request->post())) {

                $file = UploadedFile::getInstance($modelMain, 'photo');

                if (!empty($file)) {

                    $path = 'upload/files/vacancy-form/' . $file->baseName . '.' . $file->extension;
                    if ($file->saveAs($path)) {
                        $modelMain->photo = '/' . $path;
                    }
                }

                $modelEducation = MyModel::createMultiple(VacancyMessageEducation::classname());
                MyModel::loadMultiple($modelEducation, Yii::$app->request->post());

                $modelJob = MyModel::createMultiple(VacancyMessageJobs::classname());
                MyModel::loadMultiple($modelJob, Yii::$app->request->post());

                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelEducation),
                        ActiveForm::validateMultiple($modelJob),
                        ActiveForm::validate($modelMain)
                    );
                }

                // validate all models
                $valid = $modelMain->validate();
                $valid = MyModel::validateMultiple($modelEducation) && $valid;
                $valid = MyModel::validateMultiple($modelJob) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $modelMain->save(false)) {
                            foreach ($modelEducation as $modelAddress) {
                                $modelAddress->item_id = $modelMain->id;
                                if (! ($flag = $modelAddress->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }

                            foreach ($modelJob as $modelF) {
                                $modelF->item_id = $modelMain->id;
                                if (! ($flag = $modelF->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            Yii::$app->response->refresh();

                            return $this->render('vacancy-form', [
                                'vacancies' => $vacancies,
                                'modelMain' => $modelMain,
                                'modelEducation' => (empty($modelEducation)) ? [new VacancyMessageEducation()] : $modelEducation,
                                'modelJob' => (empty($modelJob)) ? [new VacancyMessageJobs()] : $modelJob
                            ]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            }

            return $this->render('vacancy-form', [
                'vacancies' => $vacancies,
                'modelMain' => $modelMain,
                'modelEducation' => (empty($modelEducation)) ? [new VacancyMessageEducation()] : $modelEducation,
                'modelJob' => (empty($modelJob)) ? [new VacancyMessageJobs()] : $modelJob
            ]);
        }
}