<?php
class code {
    protected $width = 100;
    protected $height = 44;
    protected $imgType = 'images/png';
    protected $fontsize = array('min'=>18,'max'=>22);
    protected $pic='';
    protected $letter = "ABcdefg1hi2FEg1kWR4lm5np8MBq9rs7tNKuvIwxyzab";
    public $fontfile='';
    public $fontcode = '';
    //1. 创建画布
    private function createImg(){
        $this->pic = imagecreatetruecolor($this->width,$this->height);
    }
    //2. 创建背景色

    private function fillBg(){
        $r = rand(0,127);
        $g = rand(30,127);
        $b = rand(60,127);
        $bg = imagecolorallocate($this->pic,$r,$g,$b);
        imagefill($this->pic,0,0,$bg);
    }

    private function createPointer($nums = 200){
        for($i=0;$i<$nums;$i++){
            $r = rand(60,127);
            $g = rand(0,127);
            $b = rand(30,127);
            $color = imagecolorallocate($this->pic,$r,$g,$b);
            imagesetpixel($this->pic,rand(0,$this->width),rand(0,$this->height),$color);
        }

    }

    private function createLine($nums=5){
        for($i=0;$i<$nums;$i++){
            $r = rand(60,127);
            $g = rand(0,127);
            $b = rand(30,127);
            $color = imagecolorallocate($this->pic,$r,$g,$b);
            $x1= rand(0,$this->width);
            $y1 = rand(0,20);
            $x2= rand(0,$this->width);
            $y2 = rand(0,40);
            imageline($this->pic,$x1,$y1,$x2,$y2,$color);
        }
    }
    private function getFontColor (){
        $r = rand(128,255);
        $g = rand(128,255);
        $b = rand(128,255);
        return imagecolorallocate($this->pic,$r,$g,$b);
    }
    private function getFont(){
        $ww = $this->width/4;
        $len = strlen($this->letter);
            for($i=0;$i<4;$i++){
                $w = rand(0,$len-1);
                $l = substr($this->letter,$w,1);
                $this->fontcode.=$l;
                $size = rand($this->fontsize['min'],$this->fontsize['max']);
                $color = $this->getFontColor();
                imagettftext($this->pic,$size,rand(0,15),rand($ww*$i+1,$ww*$i+10),rand(30,40),$color,$this->fontfile,$l);
            }
        $this->fontcode = strtolower($this->fontcode);
    }

    function outputImg(){
        $this->createImg();
        $this->fillBg();
        $this->createPointer(100);
        $this->createLine();
        $this->getFont();
        $type = $this->imgType;
        header("Content-Type:${type}");
        imagepng($this->pic);
        imagedestroy($this->pic);
    }
}