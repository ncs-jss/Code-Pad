<?php if(Auth::guard('admin')->check())
        $add = 'admin';
    else
        $add = '';
?>