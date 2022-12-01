
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Document</title>
</head>
<style>


.circle-wrap {
  margin-top: 20px;
  margin-left: 100px;
  width: 150px;
  height: 150px;
  background: #fefcff;
  border-radius: 50%;
  border: 1px solid #cdcbd0;
}
.circle-wrap .circle .mask,
.circle-wrap .circle .fill {
  width: 150px;
  height: 150px;
  position: absolute;
  border-radius: 50%;
}



.mask .fill {
  clip: rect(0px, 75px, 150px, 0px);
  background-color: #38e772;
}


.circle-wrap .circle .mask {
  clip: rect(0px, 150px, 150px, 75px);
}


.mask.full,
.circle .fill {
  animation: fill ease-in-out 3s;
  transform: rotate(90deg);
}



@keyframes fill{
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(90deg);
  }
}


.circle-wrap .inside-circle {
  width: 122px;
  height: 122px;
  border-radius: 50%;
  background: #d2eaf1;
  line-height: 120px;
  text-align: center;
  margin-top: 14px;
  margin-left: 14px;
  color: #38e772;
  position: absolute;
  z-index: 100;
  font-weight: 700;
  font-size: 2em;
}
</style>
<body>


<div class="recycle_round">
            
            <div class="circle-wrap" style="margin-left:270px;">
              <div class="circle" >
                <div class="mask half">
                  <div class="fill"></div>
                </div>
                <div class="mask full">
                  <div class="fill"></div>
                </div>
                <div class="inside-circle"> 50% </div>
        
              </div>
            </div>
            
          </div>



    

   

</body>
</html>