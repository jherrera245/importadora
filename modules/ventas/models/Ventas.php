<?php

namespace app\modules\ventas\models;

use app\models\Usuarios;
use app\modules\ordenes\models\Ordenes;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;


/**
 * This is the model class for table "tbl_ventas".
 *
 * @property int $id_venta
 * @property int $id_orden
 * @property string $codigo
 * @property int $num_factura
 * @property int $tipo_venta
 * @property string $fecha
 * @property int $comentarios
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 * @property int $estado
 *
 * @property Ordenes $orden
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class Ventas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ventas';
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute'=>'fecha_ing',
                'updatedAtAttribute'=>'fecha_mod',
                'value'=> date('Y-m-d H:i:s')
            ],
            [
                'class' =>BlameableBehavior::class,
                'createdByAttribute'=>'id_usuario_ing',
                'updatedByAttribute'=>'id_usuario_mod'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_orden', 'codigo', 'num_factura', 'tipo_venta', 'fecha', 'comentarios', 'estado'], 'required'],
            [['id_orden', 'num_factura', 'tipo_venta', 'id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['fecha', 'fecha_ing', 'fecha_mod'], 'safe'],
            [['codigo'], 'string', 'max' => 10],
            [['comentarios'], 'string'],
            [['id_orden'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenes::class, 'targetAttribute' => ['id_orden' => 'id_orden']],
            [['id_usuario_ing'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_ing' => 'id_usuario']],
            [['id_usuario_mod'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_mod' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_venta' => 'Id',
            'id_orden' => 'Orden',
            'codigo' => 'Codigo',
            'num_factura' => 'Número de Factura',
            'tipo_venta' => 'Tipo de Venta',
            'fecha' => 'Fecha',
            'comentarios' => 'Comentarios',
            'fecha_ing' => 'Fecha Ingreso',
            'id_usuario_ing' => 'Registrado por',
            'fecha_mod' => 'Fecha Modificación',
            'id_usuario_mod' => 'Modificado por',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Orden]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrden()
    {
        return $this->hasOne(Ordenes::class, ['id_orden' => 'id_orden']);
    }

    /**
     * Gets query for [[UsuarioIng]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIng()
    {
        return $this->hasOne(Usuarios::class, ['id_usuario' => 'id_usuario_ing']);
    }

    /**
     * Gets query for [[UsuarioMod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioMod()
    {
        return $this->hasOne(Usuarios::class, ['id_usuario' => 'id_usuario_mod']);
    }
}
