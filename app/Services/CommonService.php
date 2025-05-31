<?php

namespace App\Services;

use PhpParser\Node\Stmt\TryCatch;

class CommonService
{
    /**
     * Store or update a user model with validated data, including handling image upload.
     *
     * @param \App\Models\User $model The user model to be updated.
     * @param \Illuminate\Http\Request $request The request containing validated data.
     * @return array Notification array with message and alert type.
     */

    public function store($model, $request)
    {
        try {
            // Get validated data from the request
            $data = $request->validated();
            // Check if there is an image file in the request and handle the image upload
            if ($request->file('image')) {
                $data = $this->storeImage($data, $model, $request);
            }
            // Update the user model with the validated data
            if ($model->exists) {
                $model->update($data);
            } else {
                $model->create($data);
            }

            // Prepare the notification message
            $notification = array(
                'message' => "Data successfully updated",
                'alert-type' => 'success',
            );
            // Return the notification array
            return  $notification;
        } catch (\Exception $e) {

            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            );
            return $notification;
        }
    }

    /**
     * Handle the image upload, delete the old image if it exists, and update the data array with the new image path.
     *
     * @param array $data The validated data array.
     * @param \App\Models\User $model The user model being updated.
     * @param \Illuminate\Http\Request $request The request containing the image file.
     * @return array The updated data array with the new image path.
     */
    public function storeImage($data, $model, $request)
    {
        try {
            // Get the path of the current image
            $image_path = public_path($model->image);

            // If the model has an existing image and it exists on the server, delete it
            if ($model->image != null && file_exists($image_path)) {
                unlink($image_path);
            }
            // Handle the new image upload
            $image = $request->image;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/images'), $imageName);
            $saveUrl = 'uploads/images/' . $imageName;
            // Update the data array with the new image path
            $data['image'] = $saveUrl;
            // Return the updated data array
            return $data;
        } catch (\Exception $e) {

            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            );
            return $notification;
        }
    }

    public function destroy($model)
    {
        try {
            $model->delete();
            $notification = array(
                'message' => "Successfully data deleted",
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'success',
            );
            return $notification;
        }
    }
}
