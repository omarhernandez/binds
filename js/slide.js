
//********************************************************************

function transicion(curva,ms,callback){
    this.ant=0.01;
    this.done_=false;
    var _this=this;
    this.start=new Date().getTime();
    this.init=function(){
        setTimeout(function(){
                if(!_this.next()){
                    callback(1);
                    _this.done_=true;
                    window.globalIntervalo=0;
                    return;
                }
                callback(_this.next());
                _this.init();
            },13);
    }
    this.next=function(){
        var now=new Date().getTime();
        if((now-this.start)>ms)
            return false;
        return this.ant=curva((now-this.start+.001)/ms,this.ant);
    }
}


// *******************************************************************************
  

//*******************************************************************************
function fx(obj,inicio,fin,propCss,u,curva,ms,cola, minimize){
     
   
// *******************************************************************************
    
   if(obj.id!=null){ 

   if(obj.style[propCss]==fin+u){
     if( minimize){ // para verificar si el campo se minimiza al segundo click
       if(!window.globalIntervalo)
        window.globalIntervalo=1;
    else {
        if(cola)
            return setTimeout(function(){fx(obj,inicio,fin,propCss,u,curva,ms,cola);},30);
        else
            return;
    }    
    var t=new transicion(curva,ms,function(p){

          var delta=fin-inicio;
            obj.style[propCss]=(fin-(p*delta))+u;  
    });
    t.init();
    t=null;
    this.alreadySet=false;
     
     
        
 }  
   }
//*******************************************************************************
    else
       obj.style.display='block';
        {
        if(!window.globalIntervalo)
        window.globalIntervalo=1;
    else {
        if(cola)
            return setTimeout(function(){fx(obj,inicio,fin,propCss,u,curva,ms,cola);},30);
        else
            return;
    }    
   
    var t=new transicion(curva,ms,function(p){ 
         alreadySet=true;
        if(fin<inicio){
            var delta=inicio-fin;
            obj.style[propCss]=(inicio-(p*delta))+u;
        }
        else{  
            var delta=fin-inicio;
            obj.style[propCss]=(inicio+(p*delta))+u;
        }
    });
    t.init();
    t=null;
        }
   }
   
}
//*******************************************************************************
function senoidal(p,ant){
    return (1 - Math.cos(p * Math.PI)) / 2;
}