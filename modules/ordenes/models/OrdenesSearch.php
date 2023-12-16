<?php

namespace app\modules\ordenes\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ordenes\models\Ordenes;

/**
 * OrdenesSearch represents the model behind the search form of `app\modules\ordenes\models\Ordenes`.
 */
class OrdenesSearch extends Ordenes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_orden', 'id_cliente', 'id_direccion', 'anulado', 'id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['codigo', 'fecha', 'fecha_ing', 'fecha_mod'], 'safe'],
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
        $query = Ordenes::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id_orden' => $this->id_orden,
            'id_cliente' => $this->id_cliente,
            'id_direccion' => $this->id_direccion,
            'fecha' => $this->fecha,
            'anulado' => $this->anulado,
            'fecha_ing' => $this->fecha_ing,
            'id_usuario_ing' => $this->id_usuario_ing,
            'fecha_mod' => $this->fecha_mod,
            'id_usuario_mod' => $this->id_usuario_mod,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo]);

        return $dataProvider;
    }
}
