<?php

namespace app\modules\compras\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\compras\models\Proveedores;

/**
 * ProveedoresSearch represents the model behind the search form of `app\modules\compras\models\Proveedores`.
 */
class ProveedoresSearch extends Proveedores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proveedor', 'id_departamento', 'id_municipio', 'id_usuario_ing', 'id_usuario_mod', 'fecha_mod', 'estado'], 'integer'],
            [['codigo', 'nombre', 'descripcion', 'telefono', 'email', 'fecha_ing'], 'safe'],
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
        $query = Proveedores::find();

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
            'id_proveedor' => $this->id_proveedor,
            'id_departamento' => $this->id_departamento,
            'id_municipio' => $this->id_municipio,
            'id_usuario_ing' => $this->id_usuario_ing,
            // 'fecha_ing' => $this->fecha_ing,
            'id_usuario_mod' => $this->id_usuario_mod,
            'fecha_mod' => $this->fecha_mod,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
