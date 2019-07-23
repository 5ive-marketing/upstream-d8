<?php

namespace Drupal\field_group_background\Plugin\field_group\FieldGroupFormatter;

/**
 * @file
 * Contains \Drupal\field_group_background_image\Plugin\field_group\FieldGroupFormatter\Link.
 */

use Drupal\Component\Utility\Html;
use Drupal\Core\Template\Attribute;
use Drupal\ds\Plugin\DsField\Entity;
use Drupal\field_group\FieldGroupFormatterBase;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Drupal\media\Entity\Media;


/**
 * Plugin implementation of the 'background color' formatter.
 *
 * @FieldGroupFormatter(
 *   id = "background_color",
 *   label = @Translation("Field Group Background"),
 *   description = @Translation("Field group as a background color."),
 *   supported_contexts = {
 *     "view",
 *   }
 * )
 */
class BackgroundGroup extends FieldGroupFormatterBase{

    public function preRender(&$element, $renderingObject) {

        $attributes = new Attribute();

        // Add the HTML ID.
        if ($id = $this->getSetting('id')) {
            $attributes['id'] = Html::getId($id);
        }

        // Add the HTML classes.
        $attributes['class'] = $this->getClasses();

        // Add the color as a background of the group.
        $color = $this->getSetting('color');

        // Add the image as a background.
        $image = $this->getSetting('image');
        $imageStyle = $this->getSetting('image_style');


        // Check if the field group has a color/image selected.
        if ($style = $this->styleAttribute($renderingObject, $color, $image, $imageStyle)) {
            $attributes['style'] = $style;
        }

        elseif ($this->getSetting('hide_if_missing')) {
            hide($element);
        }

        // Render the element as a HTML div and add the attributes.
        $element['#type'] = 'container';
        $element['#attributes'] = $attributes;
    }

    // Settings
    /**
     * {@inheritdoc}
     */
    public function settingsForm() {
        $form = parent::settingsForm();

        $form['label']['#access'] = FALSE;

        if ($colorFields = $this->colorFields()) {
            $form['color'] = [
                '#title' => $this->t('Color'),
                '#type' => 'select',
                '#options' => [
                    '' => $this->t('- Select -'),
                ],
                '#default_value' => $this->getSetting('color'),
                '#weight' => 1,
            ];
            $form['color']['#options'] += $colorFields;

            $form['hide_if_missing'] = [
                '#type' => 'checkbox',
                '#title' => $this->t('Hide if missing color'),
                '#description' => $this->t('Do not render the field group if the color is missing from the selected field.'),
                '#default_value' => $this->getSetting('hide_if_missing'),
                '#weight' => 3,
            ];
        }

        else {
            $form['error'] = [
                '#markup' => $this->t('Please add a color field to use background color options.'),
            ];
        }

        if ($colorFields = $this->colorFields()) {
            $form['color'] = [
                '#title' => $this->t('Color'),
                '#type' => 'select',
                '#options' => [
                    '' => $this->t('- Select -'),
                ],
                '#default_value' => $this->getSetting('color'),
                '#weight' => 1,
            ];
            $form['color']['#options'] += $colorFields;

        }

        if ($imageFields = $this->imageFields()) {
            $form['image'] = [
                '#title' => $this->t('Image'),
                '#type' => 'select',
                '#options' => [
                    '' => $this->t('- Select -'),
                ],
                '#default_value' => $this->getSetting('image'),
                '#weight' => 1,
            ];
            $form['image']['#options'] += $imageFields;

            $form['image_style'] = [
                '#title' => $this->t('Image style'),
                '#type' => 'select',
                '#options' => [
                    '' => $this->t('- Select -'),
                ],
                '#default_value' => $this->getSetting('image_style'),
                '#weight' => 2,
            ];
            $form['image_style']['#options'] += image_style_options(FALSE);

        }
        else {
            $form['error'] = [
                '#markup' => $this->t('Please add an image field to continue.'),
            ];
        }

        $form['hide_if_missing'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Hide if missing background color/image'),
            '#description' => $this->t('Do not render the field group if the color is missing from the selected field.'),
            '#default_value' => $this->getSetting('hide_if_missing'),
            '#weight' => 3,
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = parent::settingsSummary();

        if ($color = $this->getSetting('color')) {
            $colorFields = $this->colorFields();
            $summary[] = $this->t('Color field: @color', ['@color' => $colorFields[$color]]);
        }

        if ($image = $this->getSetting('image')) {
            $imageFields = $this->imageFields();
            $summary[] = $this->t('Image field: @image', ['@image' => $imageFields[$image]]);
        }

        if ($imageStyle = $this->getSetting('image_style')) {
            $summary[] = $this->t('Image style: @style', ['@style' => $imageStyle]);
        }

        return $summary;
    }

    // Helper methods

    /**
     * @param $color
     * @return string
     */
    protected function styleAttribute($renderingObject, $color, $image, $imageStyle) {
        // set style to null.
        $style = '';

        // image validators
        $validImage = array_key_exists($image, $this->imageFields());
        $validImageStyle = ($imageStyle === '') || array_key_exists($imageStyle, image_style_options(FALSE));

        // background color exists set style to color value.
        if ($colorValue = $this->colorValue($renderingObject, $color)) {
            $style = 'background-color: ' . $colorValue . ';';
        }

        // background image exists set style to url.
        if ($validImage && $validImageStyle) {
            if ($url = $this->imageUrl($renderingObject, $image, $imageStyle)) {
                $style = strtr('background-image: url(\'@url\')', ['@url' => $url]);
            }
        }

        return $style;
    }

    /** Searches the object for the color value and returns background hex if found.
     * @param $renderingObject
     * @param $field
     * @return mixed
     */
    protected function colorValue($renderingObject, $field){

        $value = $renderingObject['#' . $this->group->entity_type]->get($field)->getValue();
        $color = $value[0]['color'];

        return $color;
    }


    /**
     * Returns an image URL to be used in the Field Group.
     *
     * @param object $renderingObject
     *   The object being rendered.
     * @param string $field
     *   Image field name.
     * @param string $imageStyle
     *   Image style name.
     *
     * @return string
     *   Image URL.
     */
    protected function imageUrl($renderingObject, $field, $imageStyle) {
        $imageUrl = '';

        /* @var EntityInterface $entity */
        if (!($entity = $renderingObject['#' . $this->group->entity_type])) {
            return $imageUrl;
        }

        if ($imageFieldValue = $renderingObject['#' . $this->group->entity_type]->get($field)->getValue()) {

            // Fid for image or entity_id.
            if (!empty($imageFieldValue[0]['target_id'])) {
                $entity_id = $imageFieldValue[0]['target_id'];

                $fieldDefinition = $entity->getFieldDefinition($field);
                // Get the media or file URI.
                if (
                    $fieldDefinition->getType() == 'entity_reference' &&
                    $fieldDefinition->getSetting('target_type') == 'media'
                ) {

                    // Load media.
                    $entity_media = Media::load($entity_id);

                    // Loop over entity fields.
                    foreach ($entity_media->getFields() as $field_name => $field) {
                        if (
                            $field->getFieldDefinition()->getType() === 'image' &&
                            $field->getFieldDefinition()->getName() !== 'thumbnail'
                        ) {
                            $fileUri = $entity_media->{$field_name}->entity->getFileUri();
                        }
                    }
                }
                else {
                    $fileUri = File::load($entity_id)->getFileUri();
                }

                // When no image style is selected, use the original image.
                if ($imageStyle === '') {
                    $imageUrl = file_create_url($fileUri);
                }
                else {
                    $imageUrl = ImageStyle::load($imageStyle)->buildUrl($fileUri);
                }
            }
        }

        return file_url_transform_relative($imageUrl);
    }



    /**
     * @return array
     */
    protected function getClasses() {
        $classes = parent::getClasses();
        $classes[] = 'field-group-background';
        $classes = array_map(['\Drupal\Component\Utility\Html', 'getClass'], $classes);

        return $classes;
    }

    /**
     * Get all color fields for the current entity and bundle.
     *
     * @return array
     *   Color field key value pair.
     */
    protected function colorFields() {

        $entityFieldManager = \Drupal::service('entity_field.manager');
        $fields = $entityFieldManager->getFieldDefinitions($this->group->entity_type, $this->group->bundle);

        $colorFields = [];
        foreach ($fields as $field) {
            if ($field->getType() === 'color_field_type') {
                $colorFields[$field->get('field_name')] = $field->label();
            }
        }

        return $colorFields;
    }

    /**
     * Get all image fields for the current entity and bundle.
     *
     * @return array
     *   Image field key value pair.
     */
    protected function imageFields() {

        $entityFieldManager = \Drupal::service('entity_field.manager');
        $fields = $entityFieldManager->getFieldDefinitions($this->group->entity_type, $this->group->bundle);

        $imageFields = [];
        foreach ($fields as $field) {
            if ($field->getType() === 'image' || ($field->getType() === 'entity_reference' && $field->getSetting('target_type') == 'media')) {
                $imageFields[$field->get('field_name')] = $field->label();
            }
        }

        return $imageFields;
    }

}