<?php

namespace app\modules\clientes\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\clientes\models\Direcciones;

/**
 * DireccionesSearch represents the model behind the search form of `app\modules\clientes\models\Direcciones`.
 */
class DireccionesSearch extends Direcciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_direccion', 'id_cliente', 'id_departamento', 'id_municipio', 'principal', 'id_usuario_ing', 'estado'], 'integer'],
            [['contacto', 'telefono', 'direccion', 'fecha_ing', 'fecha_mod', 'id_usuario_mod'], 'safe'],
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
        $query = Direcciones::find();

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
            'id_direccion' => $this->id_direccion,
            'id_cliente' => $this->id_cliente,
            'id_departamento' => $this->id_departamento,
            'id_municipio' => $this->id_municipio,
            'principal' => $this->principal,
            // 'fecha_ing' => $this->fecha_ing,
            'id_usuario_ing' => $this->id_usuario_ing,
            'fecha_mod' => $this->fecha_mod,
            'id_usuario_mod' => $this->id_usuario_mod,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'contacto', $this->contacto])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'direccion', $this->direccion]);

        return $dataProvider;
    }
}
