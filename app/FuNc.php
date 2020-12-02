<?php

function isAdmin()
{
    if(auth()->user()->is_admin == 1 && auth()->user()->is_examiner == 0)
    {
        return true;
    }
    return false;
}

function isUser()
{
    if(auth()->user()->is_admin == 0 && auth()->user()->is_examiner == 0)
    {
        return true;
    }
    return false;
}

function isExaminer()
{
    if(auth()->user()->is_admin == 0 && auth()->user()->is_examiner == 1)
    {
        return true;
    }
    return false;
}
