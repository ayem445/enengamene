<?php

namespace App\Traits;

trait BaseRequestTrait
{
    /**
     * Fonction abstraite que doit définir toutes les requête qui implémenterons ce trait
     * @var [type]
     */
    abstract public function filefolder();
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndStoreImage( $oldimage = ' ', $fieldname = 'image' ) {

        $images_folder = $this->filefolder();//'uploads/images';

        if( $this->hasFile( $fieldname ) ) {

            if (!$this->file($fieldname)->isValid()) {

                flash('Invalid Image!')->error()->important();

                return redirect()->back()->withInput();
            }

            // Check if the old image exists inside folder
            if (file_exists( $images_folder . '/' . $oldimage)) {
                $oldimage_arr = explode('.', $oldimage);
                if ($oldimage_arr[0] == 'default') {
                  // On ne supprime pas l'image par défaut
                } else {
                  unlink($images_folder . '/' . $oldimage);
                }
            }

            // Set image name
            $image = $this->{$fieldname};
            $this->fileName = md5($fieldname . '_' . time()) . '.' . $image->getClientOriginalExtension();

            // Move image to folder
            $image->move($images_folder, $this->fileName);

            return $this;
        }

        return $this;
    }
}
