<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function form_ckeditor($data)
{
    //툴바 선택사용
    switch($data['toolbar']){

		case ('reply'):
        $tool_bar = '
            [
                ["Font","FontSize"], ["TextColor","BGColor"],
                ["Bold","Italic","Underline"],
                ["JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock"],
                ["Link","Unlink"],
                ["Image","Table","HorizontalRule","Smiley","SpecialChar"],
                ["Preview","Maximize","Source","SelectAll"]
            ]
        ';
        break;

        case ('replymo'):
        $tool_bar = '
            [
                ["Font","FontSize"], ["TextColor","BGColor"],
                ["Bold","Italic","Underline"],
                ["Link","Unlink"],
                ["Image"],
                ["Source","SelectAll"]
            ]
        ';
        break;

        case ('basic'):
        $tool_bar = '
            [
                ["Source","-"],
                ["Bold","Italic","Underline"],

                ["Link","Unlink"]
            ]
        ';
        break;

        case ('custom'):
        	$tool_bar = '
            [
                ["Source","-","Save","NewPage","Preview","-","Templates"],
                ["Cut","Copy","Paste","PasteText","PasteFromWord","-","Print", "SpellChecker", "Scayt"],
                ["Undo","Redo","-","Find","Replace","-","SelectAll","RemoveFormat"],
                "/",
                ["Bold","Italic","Underline","Strike","-","Subscript","Superscript"],
                ["NumberedList","BulletedList","-","Outdent","Indent","Blockquote"],
                ["JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock"],
                ["Link","Unlink","Anchor"],
                ["Image","Flash","Table","HorizontalRule","Smiley","SpecialChar","PageBreak"],
                "/",
                ["Styles","Format","Font","FontSize"],
                ["TextColor","BGColor"],
                ["Maximize", "ShowBlocks","-","About"]
            ]
        	';
        	break;           
        //디폴트는 FUll입니다.
        default:
        $tool_bar = '
            [
                ["Source","-","Save","NewPage","Preview","-","Templates"],
                ["Cut","Copy","Paste","PasteText","PasteFromWord","-","Print", "SpellChecker", "Scayt"],
                ["Undo","Redo","-","Find","Replace","-","SelectAll","RemoveFormat"],
                ["Form", "Checkbox", "Radio", "TextField", "Textarea", "Select", "Button", "ImageButton", "HiddenField"],
                "/",
                ["Bold","Italic","Underline","Strike","-","Subscript","Superscript"],
                ["NumberedList","BulletedList","-","Outdent","Indent","Blockquote"],
                ["JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock"],
                ["Link","Unlink","Anchor"],
                ["Image","Flash","Table","HorizontalRule","Smiley","SpecialChar","PageBreak"],
                "/",
                ["Styles","Format","Font","FontSize"],
                ["TextColor","BGColor"],
                ["Maximize", "ShowBlocks","-","About"]
            ]
        ';
        break;
    }


    $data['language'] = isset($data['language']) ? $data['language'] : 'ko';

    $size    = isset($data['width']) ? 'width: "'.$data['width'].'", ' : '';
    $size  .= isset($data['height']) ? 'height: "'.$data['height'].'", ' : '';

    $options = '{'.
            $size.
            'language: "'.$data['language'].'",
            //각종 설정값 (자세한내용은 ckeditor 레퍼런스참고)
            startupOutlineBlocks: false,
            entities: false,
            entities_latin: false,
            entities_greek: false,
            forcePasteAsPlainText: false,

//파일업로드 프로그램의 주소입니다.
//ckfinder의 주소를 적으면 됩니다. 
//사용자 업로더를 사용한다면 그 주소를 써주면 됩니다.            filebrowserUploadUrl : "/include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
            filebrowserImageUploadUrl : "/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
            filebrowserFlashUploadUrl : "/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash",

            toolbar : '.$tool_bar.'

        }';
    //ckeditor 선언부
    return
    // fix: move to <HEAD...
    '<script type="text/javascript" src="/asset/ckeditor/ckeditor.js"></script>' .

    // put the CKEditor
     '<script type="text/javascript">CKEDITOR.replace("'.$data['id'].'", ' . $options . ');</script>';
}
?>