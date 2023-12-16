<?php

namespace app\modules\productos\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\productos\models\Productos;

/**
 * ProductosSearch represents the model behind the search form of `app\modules\productos\models\Productos`.
 */
class ProductosSearch extends Productos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'id_categoria', 'id_sub_categoria', 'id_marca', 'id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['nombre', 'sku', 'descripcion', 'fecha_ing', 'fecha_mod'], 'safe'],
            [['precio'], 'number'],
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
        $query = Productos::find();

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
            'id_producto' => $this->id_producto,
            'precio' => $this->precio,
            'id_categoria' => $this->id_categoria,
            'id_sub_categoria' => $this->id_sub_categoria,
            'id_marca' => $this->id_marca,
            // 'fecha_ing' => $this->fecha_ing,
            'id_usuario_ing' => $this->id_usuario_ing,
            'fecha_mod' => $this->fecha_mod,
            'id_usuario_mod' => $this->id_usuario_mod,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
