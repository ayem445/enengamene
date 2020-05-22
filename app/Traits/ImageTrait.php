<?php

namespace App\Traits;

trait ImageTrait
{
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public static function verifyAndStoreImage( Request $request, $oldimage = ' ', $fieldname = 'image' ) {

        $images_folder = 'uploads/images';

        if( $request->hasFile( $fieldname ) ) {

            if (!$request->file($fieldname)->isValid()) {

                flash('Invalid Image!')->error()->important();

                return redirect()->back()->withInput();
            }

            // Check if the old image exists inside folder
            if (file_exists( $images_folder . '/' . $oldimage)) {
                unlink($images_folder . '/' . $oldimage);
            }

            // Set image name
            $image = $request->image;
            $image_name = md5($fieldname . '_' . time()) . '.' . $image->getClientOriginalExtension();

            // Move image to folder
            $image->move($images_folder, $image_name);

            return $image_name;
        }

        return null;

    }
}
