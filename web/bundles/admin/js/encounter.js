/**
 * Created by Administrator on 2016-03-15.
 */
$(function(){
    Encounter.changeEncId();

});

var Encounter = {
    $encId : null,

    changeEncId : function(){
        Encounter.$encId = $("#encSelector").val();
    },

    loadEncounter : function(){
        $('#loadId').val(Encounter.$encId);
        $('#load').submit();
    },

    initEditor : function(){
        console.log(Encounter.encData);

    }

};

var encId = null;
