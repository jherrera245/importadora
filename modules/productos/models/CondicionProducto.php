<?php

namespace app\modules\productos\models;

use Yii;

/**
 * This is the model class for table "tbl_condicion_producto".
 *
 * @property int $id_condicion
 * @property string $nombre_condicion
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 * @property int $estado
 *
 * @property TblProductos $condicion
 * @property TblUsuarios $usuarioIng
 * @property TblUsuarios $usuarioMod
 */
class CondicionProducto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_condicion_producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_condicion', 'estado'], 'required'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['nombre_condicion'], 'string', 'max' => 50],
            [['id_usuario_ing'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsuarios::class, 'targetAttribute' => ['id_usuario_ing' => 'id_usuario']],
            [['id_usuario_mod'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsuarios::class, 'targetAttribute' => ['id_usuario_mod' => 'id_usuario']],
            [['id_condicion'], 'exist', 'skipOnError' => true, 'targetClass' => TblProductos::class, 'targetAttribute' => ['id_condicion' => 'id_condicion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_condicion' => 'Id Condicion',
            'nombre_condicion' => 'Nombre Condicion',
            'fecha_ing' => 'Fecha Ing',
            'id_usuario_ing' => 'Id Usuario Ing',
            'fecha_mod' => 'Fecha Mod',
            'id_usuario_mod' => 'Id Usuario Mod',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Condicion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCondicion()
    {
        return $this->hasOne(TblProductos::class, ['id_condicion' => 'id_condicion']);
    }

    /**
     * Gets query for [[UsuarioIng]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIng()
    {
        return $this->hasOne(TblUsuarios::class, ['id_usuario' => 'id_usuario_ing']);
    }

    /**
     * Gets query for [[UsuarioMod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioMod()
    {
        return $this->hasOne(TblUsuarios::class, ['id_usuario' => 'id_usuario_mod']);
    }
}
