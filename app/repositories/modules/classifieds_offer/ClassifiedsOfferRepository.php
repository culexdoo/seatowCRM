<?php
/*
*	Frontend Repository
*
*	Handles functions:
*/



class ClassifiedsOfferRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEntry($title, $content, $category_id, $user_id, $short_description, $color, $material, $image = null)
	{
		try
		{
			$entry = new ClassifiedOfferEntry;
			$entry->title = $title;
			$entry->category_id = $category_id;
			$entry->content = $content;
		 	$entry->user_id = $user_id;
		 	$entry->short_description = $short_description;
		 	$entry->color = $color;
		 	$entry->material = $material;


			if ($image != null)
			{
				// Image data
				$largeImagePath = public_path() . "/uploads/modules/classifiedoffer/";
				$thumbImagePath = public_path() . "/uploads/modules/classifiedoffer/thumbs/";

				// Image name is the same in thumbs and full size image
				$extension = $image->getClientOriginalExtension(); // getting image extension
				$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

				$uploadSuccess = Image::make($image->getRealPath())
					->orientate()
					->fit(768, 1024)
					->save($largeImagePath . $imagename) // original
					->crop(768, 768)
					->resize(100, 100)
					->save($thumbImagePath . $imagename) // thumb
					->destroy();

				if ($uploadSuccess)
				{
					$entry->image = $imagename;
				}
			}

			$entry->save();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


	// Editing new entry into database
	public function postEditEntry($id, $title, $content, $category_id, $short_description, $color, $material, $image = null)
	{
		 try
		{   

			$entry = ClassifiedOfferEntry::find($id); 
			$entry->title = $title; 
			$entry->content = $content;  
			$entry->category_id = $category_id;
 			$oldImage = $entry->image;
 			$entry->short_description = $short_description;
		 	$entry->color = $color;
		 	$entry->material = $material;

			if ($image != null)
			{
				// Image data
				$largeImagePath = public_path() . "/uploads/modules/classifiedoffer/";
				$thumbImagePath = public_path() . "/uploads/modules/classifiedoffer/thumbs/";

				// Image name is the same in thumbs and full size image
				$extension = $image->getClientOriginalExtension(); // getting image extension
				$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

				$uploadSuccess = Image::make($image->getRealPath())
					->orientate()
					->fit(768, 1024)
					->save($largeImagePath . $imagename) // original
					->crop(768, 768)
					->resize(100, 100)
					->save($thumbImagePath . $imagename) // thumb
					->destroy();

				if ($uploadSuccess)
				{
					$largeOldImagePath = public_path() . "/uploads/modules/classifiedoffer/" . $oldImage;
					$thumbOldImagePath = public_path() . "/uploads/modules/classifiedoffer/"  . $oldImage;

					if (File::exists($largeOldImagePath))
					{
						File::delete($largeOldImagePath);
					}
					if (File::exists($thumbOldImagePath))
					{
						File::delete($thumbOldImagePath);
					}

					$entry->image = $imagename;
				}
			}

			$entry->save();

			return array('status' => 1);
		 }
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}

	// Delete the entry item
	public function deleteEntry($id)
	{
		try
		{
			$entry = ClassifiedOfferEntry::find($id);
			$entry->delete();

			$largeOldImagePath = public_path() . "/uploads/modules/classifiedoffer/" . $entry->image;
			$thumbOldImagePath = public_path() . "/uploads/modules/classifiedoffer/thumbs/"  . $entry->image;

			if (File::exists($largeOldImagePath))
			{
				File::delete($largeOldImagePath);
			}
			if (File::exists($thumbOldImagePath))
			{
				File::delete($thumbOldImagePath);
			}

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


}
