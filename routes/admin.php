<?php

Route::resource('cours','CourController');
Route::resource('{chapitre_by_id}/sessions','SessionController');
