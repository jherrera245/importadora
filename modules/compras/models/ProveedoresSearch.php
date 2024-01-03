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
            [['id_proveedor', 'id_departamento', 'id_municipio', 'contribuyente', 'estado', 'id_usuario_ing', 'id_usuario_mod', 'fecha_mod'], 'integer'],
            [['codigo', 'nombre', 'descripcion', 'telefono', 'email', 'giro', 'nit', 'dui', 'nrc', 'nacionalidad', 'direccion_personal', 'direccion_comercial', 'razon_social', 'fecha_ing'], 'safe'],
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
            'contribuyente' => $this->contribuyente,
            'estado' => $this->estado,
            // 'fecha_ing' => $this->fecha_ing,
            'id_usuario_ing' => $this->id_usuario_ing,
            'id_usuario_mod' => $this->id_usuario_mod,
            'fecha_mod' => $this->fecha_mod,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'giro', $this->giro])
            ->andFilterWhere(['like', 'nit', $this->nit])
            ->andFilterWhere(['like', 'dui', $this->dui])
            ->andFilterWhere(['like', 'nrc', $this->nrc])
            ->andFilterWhere(['like', 'nacionalidad', $this->nacionalidad])
            ->andFilterWhere(['like', 'direccion_personal', $this->direccion_personal])
            ->andFilterWhere(['like', 'direccion_comercial', $this->direccion_comercial])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social]);

        return $dataProvider;
    }
}
