   public function save()
    {
        $this->validate();

        $slug = Str::slug($this->name);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $slug;
       
        if ($this->image) {

            $folder = 'media_categories';
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $filePath = $folder . '/' . $imageName;
            
           // Define the correct content type
            $contentType = $this->image->getMimeType();

            // Open file stream
            $fileStream = fopen($this->image->getRealPath(), 'r');


           // Upload using writeStream to set content type
           $file = Storage::disk('azure')->writeStream($filePath, $fileStream, [
                'mimetype' => $contentType, // Ensures Azure serves it correctly
            ]);

            fclose($fileStream); // Close the file stream

            if ($file) {
                $category->image = env('AZURE_STORAGE_URL') . '/' . env('AZURE_STORAGE_CONTAINER') . '/' . $filePath;
            } else {
                session()->flash('error', 'Image Upload to Azure failed.');
            }
    

        }
        
        $category->save(); //

        session()->flash('message', 'Category created successfully.');
        $this->action = 'index';
    }