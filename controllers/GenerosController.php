<?php

namespace app\controllers;

use app\models\GenerosForm;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Definición del controlador Géneros.
 */
class GenerosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $filas = \Yii::$app->db
            ->createCommand('SELECT * FROM generos ORDER BY genero')->queryAll();
        return $this->render('index', [
            'filas' => $filas,
        ]);
    }

    public function actionCreate()
    {
        $generosForm = new GenerosForm();

        if ($generosForm->load(Yii::$app->request->post()) && $generosForm->validate()) {
            Yii::$app->db->createCommand()
                ->insert('generos', $generosForm->attributes)
                ->execute();
            Yii::$app->session->setFlash('success', 'Fila insertada correctamente.');
            return $this->redirect(['generos/index']);
        }
        return $this->render('create', [
            'generosForm' => $generosForm,
        ]);
    }

    public function actionUpdate($id)
    {
        $generosForm = new GenerosForm(['attributes' => $this->buscarGenero($id)]);

        if ($generosForm->load(Yii::$app->request->post()) && $generosForm->validate()) {
            Yii::$app->db->createCommand()
                ->update('generos', $generosForm->attributes, ['id' => $id])
                ->execute();
            Yii::$app->session->setFlash('success', 'Género modificado correctamente');
            return $this->redirect(['generos/index']);
        }

        return $this->render('update', [
            'generosForm' => $generosForm,
            'listaGeneros' => $this->listaGeneros(),
        ]);
    }

    public function actionDelete($id)
    {
        if (Yii::$app->db
            ->createCommand('SELECT id
                               FROM peliculas
                              WHERE genero_id = :id
                              LIMIT 1', [':id' => $id])
            ->queryOne() != false) {
            Yii::$app->session->setFlash('error', 'el género esta siendo usado.');
        // return $this->redirect(['generos/index']);
        } else {
            Yii::$app->db->createCommand()->delete('generos', ['id' => $id])->execute();
            Yii::$app->session->setFlash('success', 'Género borrado correctamente');
        }
        return $this->redirect(['generos/index']);
    }

    private function listaGeneros()
    {
        $generos = Yii::$app->db->createCommand('SELECT * FROM generos')->queryAll();
        $listaGeneros = [];
        foreach ($generos as $genero) {
            $listaGeneros[$genero['id']] = $genero['genero'];
        }
        return $listaGeneros;
    }

    private function buscarGenero($id)
    {
        $fila = Yii::$app->db
            ->createCommand('SELECT *
                               FROM generos
                              WHERE id = :id', [':id' => $id])->queryOne();
        if (empty($fila)) {
            throw new NotFoundHttpException('Este género no existe.');
        }
        return $fila;
    }
}
