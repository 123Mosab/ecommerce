<?php

function getFolder()
{
    return App()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}