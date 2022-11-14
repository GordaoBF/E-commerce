
    function checkedBtn(){
        var form4 = document.getElementById('desconto');
        var activeBtn4 = document.getElementById('idpromocao');

        if (activeBtn4.checked) {
            form4.classList.add("mostrar");
            form4.classList.remove("nmostrar");
            document.getElementById("iddesconto").type = 'number';
            document.getElementById("iddesconto").required = true;
        }else{
            form4.classList.remove("mostrar");
            form4.classList.add("nmostrar");
            document.getElementById("iddesconto").type = 'hidden';
            document.getElementById("iddesconto").required = false;
        }
    }
    function checkedBtnList(){
        var activeBtn1 = document.getElementById('switch');
        var activeBtn2 = document.getElementById('switch2');
        var activeBtn3 = document.getElementById('switch3');
        
        
        var form1 = document.getElementById('cliente');
        var form2 = document.getElementById('usuario');
        var form3 = document.getElementById('produto');
        var form4 = document.getElementById('desconto');
        var activeBtn4 = document.getElementById('idpromocao');
        
        var req = document.querySelectorAll('pro');
        var req2 = document.querySelectorAll('us');
        var req3 = document.querySelectorAll('client');
        
        if(activeBtn3.checked){
            form3.classList.add("mostrar");
            form3.classList.remove("nmostrar");
            form1.classList.add("nmostrar");
            form1.classList.remove("mostrar");
            form2.classList.add("nmostrar");
            form2.classList.remove("mostrar");
            req.required = true;
            req2.required = false;
            req3.required = false;
        }else if (activeBtn1.checked) {
            form1.classList.add('mostrar');
            form1.classList.remove("nmostrar");
            form2.classList.add("nmostrar");
            form2.classList.remove("mostrar");
            form3.classList.add("nmostrar");
            form3.classList.remove("mostrar");
            req.required = false;
            req2.required = false;
            req3.required = true;
        }else if(activeBtn2.checked){
            form2.classList.add("mostrar");
            form2.classList.remove("nmostrar");
            form1.classList.add("nmostrar");
            form1.classList.remove("mostrar");
            form3.classList.add("nmostrar");
            form3.classList.remove("mostrar");
            req.required = false;
            req2.required = true;
           req3.required = false;
        }else {
            form1.classList.add("nmostrar");
            form1.classList.remove("mostrar");
            form2.classList.add("nmostrar");
            form2.classList.remove("mostrar");
            form3.classList.add("nmostrar");
            form3.classList.remove("mostrar");
            req.required = false;
            req2.required = false;
            req3.required = false;
        }
    }