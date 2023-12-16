<?php

namespace app\modules\ordenes\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ordenes\models\DetOrdenes;

/**
 * DetOrdenesSearch represents the model behind the search form of `app\modules\ordenes\models\DetOrdenes`.
 */
class DetOrdenesSearch extends DetOrdenes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_det_orden', 'id_orden', 'id_producto', 'cantidad', 'id_usuario_ing', 'id_usuario_mod'], 'integer'],
            [['precio', 'descuento'], 'number'],
            [['uuid', 'fecha_ing', 'fecha_mod'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DetOrdenes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!is_null($this->fecha_ing) && strpos($this->fecha_ing, ' - ') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->fecha_ing);
            $query->andFilterWhere(['between', 'fecha_ing', $start_date.' '.'00:00:00', $end_date.' '.'23:59:59']);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_det_orden' => $this->id_det_orden,
            'id_orden' => $this->id_orden,
            'id_producto' => $this->id_producto,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'descuento' => $this->descuento,
            // 'fecha_ing' => $this->fecha_ing,
            'id_usuario_ing' => $this->id_usuario_ing,
            'fecha_mod' => $this->fecha_mod,
            'id_usuario_mod' => $this->id_usuario_mod,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid]);

        return $dataProvider;
    }
}
