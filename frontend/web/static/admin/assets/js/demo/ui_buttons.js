"use strict";
$(document).ready(function(){
    $("#btn-load").on("click",function(){
        var a=$(this);
        a.button("loading");
        setTimeout(function(){
            a.button("reset")
            },1500)
        });
    $("#btn-load-then-complete").on("click",function(){
        var a=$(this);
        a.button("loading");
        setTimeout(function(){
            a.button("complete")
            },1500)
        })
    });