<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_municipios".
 *
 * @property int $id_municipio
 * @property string $nombre
 * @property int $id_departamento
 *
 * @property TblDepartamentos $departamento
 * @property TblProveedores[] $tblProveedores
 */
class Municipios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_municipios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'id_departamento'], 'required'],
            [['id_departamento'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => TblDepartamentos::class, 'targetAttribute' => ['id_departamento' => 'id_departamento']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_municipio' => 'Id Municipio',
            'nombre' => 'Nombre',
            'id_departamento' => 'Id Departamento',
        ];
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(TblDepartamentos::class, ['id_departamento' => 'id_departamento']);
    }

    /**
     * Gets query for [[TblProveedores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblProveedores()
    {
        return $this->hasMany(TblProveedores::class, ['id_municipio' => 'id_municipio']);
    }
}
