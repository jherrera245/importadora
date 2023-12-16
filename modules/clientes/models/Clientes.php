<?php

namespace app\modules\clientes\models;

use app\models\Usuarios;
use app\modules\clientes\models\Direcciones;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;

/**
 * This is the model class for table "tbl_clientes".
 *
 * @property int $id_cliente
 * @property string $nombre
 * @property string $apellido
 * @property string $telefono
 * @property string $email
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 * @property int $estado
 *
 * @property Direcciones[] $Direcciones
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_clientes';
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
            [['nombre', 'apellido', 'telefono', 'email', 'estado'], 'required'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 255],
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
            'id_cliente' => 'Id',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'telefono' => 'Teléfono',
            'email' => 'Email',
            'fecha_ing' => 'Fecha de Ingreso',
            'id_usuario_ing' => 'Ingresado por',
            'fecha_mod' => 'Fecha de Modoficación',
            'id_usuario_mod' => 'Modificado por',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Direcciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirecciones()
    {
        return $this->hasMany(Direcciones::class, ['id_cliente' => 'id_cliente']);
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
