<?php

namespace app\modules\productos\models;
use app\modules\productos\models\ProductosImagenes;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\models\Usuarios;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "tbl_productos".
 *
 * @property int $id_producto
 * @property string $nombre
 * @property string $sku
 * @property string|null $descripcion
 * @property float $precio
 * @property int $id_categoria
 * @property int $id_sub_categoria
 * @property int $id_marca
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 * @property int $estado
 *
 * @property Categorias $categoria
 * @property Marcas $marca
 * @property SubCategorias $subCategoria
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class Productos extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = 'productos';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_productos';
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
            [['nombre', 'sku', 'precio', 'id_categoria', 'id_sub_categoria', 'id_marca', 'estado'], 'required'],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['id_categoria', 'id_sub_categoria', 'id_marca', 'id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['nombre', 'sku'], 'string', 'max' => 100],
            [['sku'], 'unique'], //definiendo sku como unico
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['id_categoria' => 'id_categoria']],
            [['id_marca'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::class, 'targetAttribute' => ['id_marca' => 'id_marca']],
            [['id_sub_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategorias::class, 'targetAttribute' => ['id_sub_categoria' => 'id_sub_categoria']],
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
            'id_producto' => 'Id',
            'nombre' => 'Nombre',
            'sku' => 'SKU',
            'descripcion' => 'Descripción',
            'precio' => 'Precio',
            'id_categoria' => 'Categoria',
            'id_sub_categoria' => 'Sub Categoria',
            'id_marca' => 'Marca',
            'fecha_ing' => 'Fecha Ingreso',
            'id_usuario_ing' => 'Usuario Ingreso',
            'fecha_mod' => 'Fecha Modificación',
            'id_usuario_mod' => 'Usuario Modificación',
            'estado' => 'Estado',
        ];
    }

    public static function getRutaProductos(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getRutaUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getThumbnails($id, $principal)
    {
        $imagenes = ProductosImagenes::find()->where(['id_producto'=>$id, 'principal'=>$principal])->all();
        $preview = [];

        foreach ($imagenes as $imagen) {
            $preview[] = [
                'title' => $imagen->imagen,
                'url' => self::getRutaUrl(true)."{$id}/{$imagen->imagen}",
                'src' => self::getRutaUrl(true)."{$id}/thumbnail/{$imagen->imagen}",
                'options' => ['title' => $imagen->imagen]
            ];
        }

        return $preview;
    }

    public static function getImagenPrincipal($id, $principal){
        $imagen = ProductosImagenes::find()->where(['id_producto'=>$id, 'principal'=>$principal])->one();

        if ($imagen) {
            return self::getRutaUrl(true)."{$id}/thumbnail/{$imagen->imagen}";
        }

        return self::getRutaUrl(true)."no_imagen.jpg";
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[Marca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(Marcas::class, ['id_marca' => 'id_marca']);
    }

    /**
     * Gets query for [[SubCategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoria()
    {
        return $this->hasOne(SubCategorias::class, ['id_sub_categoria' => 'id_sub_categoria']);
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
