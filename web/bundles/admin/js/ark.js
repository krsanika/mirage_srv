/**
 * Created by Administrator on 2016-03-15.
 */
$(function(){
    Ark.changeArkId();
    Ark.$oribox = $('#ori_tags');
    Ark.TagBoxInitialize();
});

var Ark = {
    $arkId : null,
    $oribox : null,

    changeArkId : function(){
        Ark.$arkId = $("#arkSelector").val();
    },

    loadArk : function(){
        $('#loadId').val(Ark.$arkId);
        $('#load').submit();
    },

    initEditor : function(){
        console.log(Encounter.arkData);

    },
    $tags : [],

    TagBoxInitialize : function(){
        $.each($('.tagBox'), function(i, tagbox){
            var setterBox = Ark.$oribox.clone().show();
//            var setterNum = $(tagbox).attr('id').replace(/[^0-9^\.]/g,"");
            setterBox.attr({id : "setterBox"+i, class : "setterBox"});
            $(tagbox).after(setterBox);
            var tag = [];
            $.each($(tagbox).children(), function(j, data){
                tag.push($(data).val());
                setterBox.children($(data).val()).attr('selected', 'selected');
            });
            Ark.$tags[i] = tag;
        });

    }
};

var arkId = null;
