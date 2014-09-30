        
        function goBack(){
          window.history.back();
        }
        
        window.onload = function (){
          var eBackButton = document.getElementById('back-button');
          if (eBackButton !== null){
          eBackButton.addEventListener('click', goBack);
          }        
        };
        