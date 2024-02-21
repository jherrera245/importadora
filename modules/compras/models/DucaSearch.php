<?php

namespace app\modules\compras\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\compras\models\Duca;

/**
 * DucaSearch represents the model behind the search form of `app\modules\compras\models\Duca`.
 */
class DucaSearch extends Duca
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_duca', 'no_correlativo', 'no_duca', 'id_compra', 'id_usuario_ing', 'id_usuario_mod'], 'integer'],
            [['fecha_aceptacion', 'nombre_transportista', 'modo_transporte', 'pais _procedencia', 'pais_destino', 'pais _exportacion', 'fecha_ing', 'fecha_mod'], 'safe'],
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
        $query = Duca::find();

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
            'id_duca' => $this->id_duca,
            'no_correlativo' => $this->no_correlativo,
            'no_duca' => $this->no_duca,
            'fecha_aceptacion' => $this->fecha_aceptacion,
            'id_compra' => $this->id_compra,
            'fecha_ing' => $this->fecha_ing,
            'id_usuario_ing' => $this->id_usuario_ing,
            'fecha_mod' => $this->fecha_mod,
            'id_usuario_mod' => $this->id_usuario_mod,
        ]);

        $query->andFilterWhere(['like', 'nombre_transportista', $this->nombre_transportista])
            ->andFilterWhere(['like', 'modo_transporte', $this->modo_transporte])
            ->andFilterWhere(['like', 'pais_procedencia', $this->pais_procedencia])
            ->andFilterWhere(['like', 'pais_destino', $this->pais_destino])
            ->andFilterWhere(['like', 'pais_exportacion', $this->pais_exportacion]);

        return $dataProvider;
    }
}
