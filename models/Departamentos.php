<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_departamentos".
 *
 * @property int $id_departamento
 * @property string $nombre
 * @property string $codigo
 *
 * @property Municipios[] $Municipios
 * @property Proveedores[] $Proveedores
 */
class Departamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_departamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'codigo'], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['codigo'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_departamento' => 'Id Departamento',
            'nombre' => 'Nombre',
            'codigo' => 'Codigo',
        ];
    }

    /**
     * Gets query for [[Municipios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipios::class, ['id_departamento' => 'id_departamento']);
    }

    /**
     * Gets query for [[Proveedores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProveedores()
    {
        return $this->hasMany(Proveedores::class, ['id_departamento' => 'id_departamento']);
    }
}
