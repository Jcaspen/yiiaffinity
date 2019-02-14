<?php

namespace app\controllers;

use app\models\Generos;
use app\models\Personas;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PersonasController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['update'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => Generos::find()->count(),
        ]);

        $filas = Personas::find()
            ->limit($pagination->limit)
            ->offset($pagination->offset)
            ->all();

        return $this->render('index', [
            'filas' => $filas,
            'pagination' => $pagination,
        ]);
    }

    public function actionCreate()
    {
        $persona = new Personas();

        if ($persona->load(Yii::$app->request->post()) && $persona->save()) {
            Yii::$app->session->setFlash('success', 'Fila insertada correctamente.');
            return $this->redirect(['personas/index']);
        }

        return $this->render('create', [
            'nombre' => $persona,
        ]);
    }

    public function actionUpdate($id)
    {
        $persona = $this->buscarPersona($id);
        if ($persona->load(Yii::$app->request->post()) && $persona->save()) {
            Yii::$app->session->setFlash('success', 'Fila modificada correctamente.');
            return $this->redirect(['personas/index']);
        }
        return $this->render('update', [
            'nombre' => $persona,
        ]);
    }

    /**
     * Borra un género.
     * @param  int      $id El id del género a borrar
     * @return Response     Una redirección
     */
    public function actionDelete($id)
    {
        $persona = $this->buscarPersona($id);
        if (empty($persona->peliculas)) {
            $persona->delete();
            Yii::$app->session->setFlash('success', 'Participante borrado correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'Este participante tiene peliculas.');
        }
        return $this->redirect(['personas/index']);
    }

    /**
     * Localiza un participante por su id.
     * @param  int                   $id El id del participante
     * @return array                     El participante si existe
     * @throws NotFoundHttpException     Si el participante no existe
     */
    private function buscarPersona($id)
    {
        $persona = Personas::findOne($id);
        if ($persona === null) {
            throw new NotFoundHttpException('El participante no existe.');
        }
        return $persona;
    }
}
