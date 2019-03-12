<?php

namespace frontend\controllers;

use frontend\models\Country;
use yii\data\Pagination;
use yii\web\Controller;

class CountryController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count()
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination
        ]);
    }

    /**
     * @param string $k
     */
    public function actionSearch($k = "US")
    {
        $country = Country::findOne($k);

        var_dump($country);
    }

    /**
     * @param string $k
     */
    public function actionEdit($k = "US")
    {
        $country = Country::findOne($k);
        $country->name = 'U.S.A';
        $country->save();

        var_dump($country->name);
    }
}
