<?php

namespace app\modules\productos\models;
use app\models\Usuarios;
use Yii;

/**
 * This is the model class for table "tbl_productos_imagenes".
 *
 * @property int $id_producto_imagen
 * @property int $id_producto
 * @property string $imagen
 * @property int $principal
 * @property string $fecha_ing
 * @property int $id_usuario_ing
 *
 * @property Productos $producto
 * @property Usuarios $usuarioIng
 */
class ProductosImagenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_productos_imagenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'imagen', 'principal', 'fecha_ing', 'id_usuario_ing'], 'required'],
            [['id_producto', 'principal', 'id_usuario_ing'], 'integer'],
            [['fecha_ing'], 'safe'],
            [['imagen'], 'string', 'max' => 255],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['id_producto' => 'id_producto']],
            [['id_usuario_ing'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_ing' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_producto_imagen' => 'Id Producto Imagen',
            'id_producto' => 'Id Producto',
            'imagen' => 'Imagen',
            'principal' => 'Principal',
            'fecha_ing' => 'Fecha Ing',
            'id_usuario_ing' => 'Id Usuario Ing',
        ];
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::class, ['id_producto' => 'id_producto']);
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
}
