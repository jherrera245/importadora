<?php

namespace app\modules\inventario\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\Inventario;

/**
 * InventarioSearch represents the model behind the search form of `app\modules\inventario\models\Inventario`.
 */
class InventarioSearch extends Inventario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_inventario', 'id_producto', 'existencia', 'existencia_original', 'id_usuario_ing'], 'integer'],
            [['uuid', 'fecha_ing'], 'safe'],
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
        $query = Inventario::find();

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
            'id_inventario' => $this->id_inventario,
            'id_producto' => $this->id_producto,
            'existencia' => $this->existencia,
            'existencia_original' => $this->existencia_original,
            // 'fecha_ing' => $this->fecha_ing,
            'id_usuario_ing' => $this->id_usuario_ing,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid]);

        return $dataProvider;
    }
}
