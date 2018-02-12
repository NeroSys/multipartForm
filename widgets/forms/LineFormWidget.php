<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 1/14/18
 * Time: 4:09 PM
 */

namespace frontend\widgets\forms;


use common\models\ckm\LineMessages;
use common\models\ckm\LinePersonnelFeedback;
use common\models\ckm\LinePersonnelTrouble;
use yii\base\Widget;
use Yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\db\Exception;
use frontend\widgets\models\MyModel;
use yii\web\NotFoundHttpException;

class LineFormWidget extends Widget
{


    public function init(){

    }

    public function run() {


        $modelMain = new LineMessages;
        $modelTrouble = [
            new LinePersonnelTrouble
            ];
        $modelFeedback = [
            new LinePersonnelFeedback
        ];

        if ($modelMain->load(Yii::$app->request->post())) {

            $file = UploadedFile::getInstance($modelMain, 'file');

            if (!empty($file)) {

                $path = 'upload/files/line-form/' . $file->baseName . '.' . $file->extension;
                if ($file->saveAs($path)) {
                    $modelMain->file = '/' . $path;
                }
            }

            $modelTrouble = MyModel::createMultiple(LinePersonnelTrouble::classname());
            MyModel::loadMultiple($modelTrouble, Yii::$app->request->post());

            $modelFeedback = MyModel::createMultiple(LinePersonnelFeedback::classname());
            MyModel::loadMultiple($modelFeedback, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelTrouble),
                    ActiveForm::validateMultiple($modelFeedback),
                    ActiveForm::validate($modelMain)
                );
            }

            // validate all models
            $valid = $modelMain->validate();
            $valid = MyModel::validateMultiple($modelTrouble) && $valid;
            $valid = MyModel::validateMultiple($modelFeedback) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelMain->save(false)) {
                        foreach ($modelTrouble as $modelAddress) {
                            $modelAddress->item_id = $modelMain->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                        foreach ($modelFeedback as $modelF) {
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

                        return $this->render('line-form', [
                            'modelMain' => $modelMain,
                            'modelTrouble' => (empty($modelTrouble)) ? [new LinePersonnelTrouble()] : $modelTrouble,
                            'modelFeedback' => (empty($modelFeedback)) ? [new LinePersonnelFeedback()] : $modelFeedback
                        ]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('line-form', [
            'modelMain' => $modelMain,
            'modelTrouble' => (empty($modelTrouble)) ? [new LinePersonnelTrouble()] : $modelTrouble,
            'modelFeedback' => (empty($modelFeedback)) ? [new LinePersonnelFeedback()] : $modelFeedback
        ]);

//        $model = new LineMessages();
//
//
//        if (Yii::$app->request->isPost && $model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
//
//            Yii::$app->session->setFlash('subscribeMsg', 'OK', false);
//            Yii::$app->response->refresh();
//
//        } else {
//            Yii::$app->session->setFlash('subscribeMsg', 'Шо-то пошло не так', false);
//            // Yii::$app->response->refresh();
//        }
//
//
//
//        return $this->render('line-form',  compact( 'model'));


    }

}