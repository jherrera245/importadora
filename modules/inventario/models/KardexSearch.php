<?php

namespace app\modules\inventario\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\Kardex;

/**
 * KardexSearch represents the model behind the search form of `app\modules\inventario\models\Kardex`.
 */
class KardexSearch extends Kardex
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kardex', 'id_documento', 'id_producto', 'cantidad', 'id_usuario_ing'], 'integer'],
            [['cod_documento', 'num_documento', 'tipo_documento', 'uuid', 'fecha_ing'], 'safe'],
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
        $query = Kardex::find();

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
            'id_kardex' => $this->id_kardex,
            'id_documento' => $this->id_documento,
            'id_producto' => $this->id_producto,
            'cantidad' => $this->cantidad,
            'fecha_ing' => $this->fecha_ing,
            'id_usuario_ing' => $this->id_usuario_ing,
        ]);

        $query->andFilterWhere(['like', 'cod_documento', $this->cod_documento])
            ->andFilterWhere(['like', 'num_documento', $this->num_documento])
            ->andFilterWhere(['like', 'tipo_documento', $this->tipo_documento])
            ->andFilterWhere(['like', 'uuid', $this->uuid]);

        return $dataProvider;
    }
}
