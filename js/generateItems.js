async function getOddOrEven(){
  let response = await fetch('api/items-list/');
  let data = await response.json();
  let odd = data.length % 2;
  if(odd){
    createItemsOdd();
  }else{ 
    createItemsEven();
  }
}
getOddOrEven();
setInterval(updateItems,60000);

function clearCategory(){
  let arrayClasses = document.getElementsByClassName("col-sm");
  
  for(let i = 0; i < arrayClasses.length; i++){
    arrayClasses[i].style.display = "block";
  }
}

function categorySelect(category_id){
  let arrayClasses = document.getElementsByClassName(category_id);
  
  for(let i = 0; i < arrayClasses.length; i++){
    arrayClasses[i].style.display = "none";
  }

}

async function updateItems(){
  let response = await fetch('api/items-list/');
  let data = await response.json();
  let odd = data.length % 2;
  
  let parent = document.getElementById("container");
  parent.innerHTML = " ";
  if(odd){
    createItemsOdd();
    
    
  }else{
    createItemsEven();
    
    
      
    }
  }





 async function createItemsEven(){
    let response = await fetch('api/items-list/');
    let data = await response.json();
    
      for(let i = 0; i < Math.floor(data.length/2); i++){
        let row = document.createElement("div");
        
        row.setAttribute("class", "row");
        row.setAttribute("id",i);
        document.getElementById("container").appendChild(row);       
        let col1 = document.createElement("div");
        col1.setAttribute("class", "col-sm"+" "+data[i]['category_id']);
        col1.setAttribute("id", "left-"+i);
       
        document.getElementById(i).appendChild(col1);
        let col2 = document.createElement("div");
        col2.setAttribute("class", "col-sm"+" "+data[i]['category_id']);
        col2.setAttribute("id", "right-"+i );
        
        document.getElementById(i).appendChild(col2);
     
      }

      for(let i = 0; i < Math.floor(data.length/2); i++){
          let inputLeft = document.createElement("input");
          let inputRight = document.createElement("input");
          let labelLeft = document.createElement("label");
          let labelRight = document.createElement("label");
          let imgLeft = document.createElement("img");
          let imgRight = document.createElement("img");

          

        

          if(data[2*i]['taken_status'] == 0){
            
            inputLeft.setAttribute("class", "btn");
            inputLeft.setAttribute("name", data[2*i]['oprema_id']);
            inputLeft.setAttribute("type", "checkbox");
            inputLeft.setAttribute("value", data[2*i]['oprema_id']);

            labelLeft.setAttribute("for",data[2*i]['oprema_id']);
            labelLeft.setAttribute("class",'oprema');
            labelLeft.appendChild(document.createTextNode(data[2*i]['oprema_ime']));

            imgLeft.setAttribute("src","img/oprema/"+data[2*i]['image']);
            imgLeft.setAttribute("class", 'image');
            
          }else{
            
            inputLeft.setAttribute("class", "btn");
            inputLeft.setAttribute("name", data[2*i]['oprema_id']);
            inputLeft.setAttribute("type", "checkbox");
            inputLeft.setAttribute("value", data[2*i]['oprema_id']);
            inputLeft.disabled = true;

            labelLeft.setAttribute("for",data[2*i]['oprema_id']);
            labelLeft.setAttribute("class",'oprema disabled');
            labelLeft.appendChild(document.createTextNode(data[2*i]['oprema_ime']));
            imgLeft.setAttribute("src","img/oprema/"+data[2*i]['image']);
            imgLeft.setAttribute("class", 'image');
          }

          if(data[2*i+1]['taken_status'] == 0){
            
            inputRight.setAttribute("class", "btn");
            inputRight.setAttribute("name", data[2*i+1]['oprema_id']);
            inputRight.setAttribute("type", "checkbox");
            inputRight.setAttribute("value", data[2*i+1]['oprema_id']);

            labelRight.setAttribute("for",data[2*i+1]['oprema_id']);
            labelRight.setAttribute("class",'oprema');
            labelRight.appendChild(document.createTextNode(data[2*i+1]['oprema_ime']));
            imgRight.setAttribute("src","img/oprema/"+data[2*i+1]['image']);
            imgRight.setAttribute("class", 'image');

          }else{
            
            inputRight.setAttribute("class", "btn");
            inputRight.setAttribute("name", data[2*i+1]['oprema_id']);
            inputRight.setAttribute("type", "checkbox");
            inputRight.setAttribute("value", data[2*i+1]['oprema_id']);
            inputRight.disabled = true;

            labelRight.setAttribute("for",data[2*i+1]['oprema_id']);
            labelRight.setAttribute("class",'oprema disabled');
            labelRight.appendChild(document.createTextNode(data[2*i+1]['oprema_ime']));
            imgRight.setAttribute("src","img/oprema/"+data[2*i+1]['image']);
            imgRight.setAttribute("class", 'image');
          }

          
          document.getElementById("left-"+i).appendChild(inputLeft);
          document.getElementById("right-"+i).appendChild(inputRight);
          document.getElementById("left-"+i).appendChild(labelLeft);
          document.getElementById("right-"+i).appendChild(labelRight);
          document.getElementById("left-"+i).appendChild(imgLeft);
          document.getElementById("right-"+i).appendChild(imgRight);

          




      }
    }
    

    async function createItemsOdd(){
      let response = await fetch('api/items-list/');
      let data = await response.json();
      console.log(data);
        for(let i = 0; i < Math.floor(data.length/2); i++){
          let row = document.createElement("div");
          
          row.setAttribute("class", "row");
          row.setAttribute("id",i);
          document.getElementById("container").appendChild(row);
          
          let col1 = document.createElement("div");
          //col1.appendChild(document.createTextNode("left"));
          col1.setAttribute("class", "col-sm"+" "+data[i]['category_id']);
          col1.setAttribute("id", "left-"+i);
          
          document.getElementById(i).appendChild(col1);
  
          let col2 = document.createElement("div");
          //col2.appendChild(document.createTextNode("right"));
          col2.setAttribute("class", "col-sm"+" "+data[i]['category_id']);
          col2.setAttribute("id", "right-"+i);
          
          document.getElementById(i).appendChild(col2);
       
        }
  
        for(let i = 0; i < Math.floor(data.length/2); i++){
            let inputLeft = document.createElement("input");
            let inputRight = document.createElement("input");
            let labelLeft = document.createElement("label");
            let labelRight = document.createElement("label");
            let imgLeft = document.createElement("img");
            let imgRight = document.createElement("img");
  
            
  
            /*inputLeft.setAttribute("class", "btn");
            inputLeft.setAttribute("name", data[i+1]['oprema_id']);
            inputLeft.setAttribute("type", "checkbox");
            inputLeft.setAttribute("value", data[i+1]['oprema_id']);*/
  
            if(data[2*i]['taken_status'] == 0){
              
              inputLeft.setAttribute("class", "btn");
              inputLeft.setAttribute("name", data[2*i]['oprema_id']);
              inputLeft.setAttribute("type", "checkbox");
              inputLeft.setAttribute("value", data[2*i]['oprema_id']);
              
  
              labelLeft.setAttribute("for",data[2*i]['oprema_id']);
              labelLeft.setAttribute("class",'oprema');
              labelLeft.appendChild(document.createTextNode(data[2*i]['oprema_ime']));
  
              imgLeft.setAttribute("src","img/oprema/"+data[2*i]['image']);
              imgLeft.setAttribute("class", 'image');
              
            }else{
              
              inputLeft.setAttribute("class", "btn");
              inputLeft.setAttribute("name", data[2*i]['oprema_id']);
              inputLeft.setAttribute("type", "checkbox");
              inputLeft.setAttribute("value", data[2*i]['oprema_id']);
              inputLeft.disabled = true;
  
              labelLeft.setAttribute("for",data[2*i]['oprema_id']);
              labelLeft.setAttribute("class",'oprema disabled');
              labelLeft.appendChild(document.createTextNode(data[2*i]['oprema_ime']));
              imgLeft.setAttribute("src","img/oprema/"+data[2*i]['image']);
              imgLeft.setAttribute("class", 'image');
            }
  
            if(data[2*i+1]['taken_status'] == 0){
              
              inputRight.setAttribute("class", "btn");
              inputRight.setAttribute("name", data[2*i+1]['oprema_id']);
              inputRight.setAttribute("type", "checkbox");
              inputRight.setAttribute("value", data[2*i+1]['oprema_id']);
              
  
              labelRight.setAttribute("for",data[2*i+1]['oprema_id']);
              labelRight.setAttribute("class",'oprema');
              labelRight.appendChild(document.createTextNode(data[2*i+1]['oprema_ime']));
              imgRight.setAttribute("src","img/oprema/"+data[2*i+1]['image']);
              imgRight.setAttribute("class", 'image');
  
            }else{
              
              inputRight.setAttribute("class", "btn");
              inputRight.setAttribute("name", data[2*i+1]['oprema_id']);
              inputRight.setAttribute("type", "checkbox");
              inputRight.setAttribute("value", data[2*i+1]['oprema_id']);
              inputRight.disabled = true;
  
              labelRight.setAttribute("for",data[2*i+1]['oprema_id']);
              labelRight.setAttribute("class",'oprema disabled');
              labelRight.appendChild(document.createTextNode(data[2*i+1]['oprema_ime']));
              imgRight.setAttribute("src","img/oprema/"+data[2*i+1]['image']);
              imgRight.setAttribute("class", 'image');
            }
  
            
            document.getElementById("left-"+i).appendChild(inputLeft);
            document.getElementById("right-"+i).appendChild(inputRight);
            document.getElementById("left-"+i).appendChild(labelLeft);
            document.getElementById("right-"+i).appendChild(labelRight);
            document.getElementById("left-"+i).appendChild(imgLeft);
            document.getElementById("right-"+i).appendChild(imgRight);
        }
        

        let id = Math.ceil(data.length/2)-1;
        console.log(id+" id");
        let row = document.createElement("div");
        console.log(data[data.length-1]);
          
        row.setAttribute("class", "row");
        row.setAttribute("id",id);
        document.getElementById("container").appendChild(row);
        
        let col1 = document.createElement("div");
        //col1.appendChild(document.createTextNode("left"));
        col1.setAttribute("class", "col-sm");
        col1.setAttribute("id", "left-"+id);
        document.getElementById(id).appendChild(col1);

      
        let input = document.createElement("input");
        let label = document.createElement("label");
        let img = document.createElement("img");
        if(data[data.length-1]['taken_status'] == 0){
              input.setAttribute("class", "btn");
              input.setAttribute("name", data[data.length-1]['oprema_id']);
              input.setAttribute("type", "checkbox");
              input.setAttribute("value", data[data.length-1]['oprema_id']);
  
              label.setAttribute("for",data[data.length-1]['oprema_id']);
              label.setAttribute("class",'oprema');
              label.appendChild(document.createTextNode(data[data.length-1]['oprema_ime']));
              img.setAttribute("src","img/oprema/"+data[data.length-1]['image']);
              img.setAttribute("class", 'image');
        }else{
          input.setAttribute("class", "btn");
              input.setAttribute("name", data[data.length-1]['oprema_id']);
              input.setAttribute("type", "checkbox");
              input.disabled = true;
              input.setAttribute("value", data[data.length-1]['oprema_id']);
  
              label.setAttribute("for",data[data.length-1]['oprema_id']);
              label.setAttribute("class",'oprema disabled');
              label.appendChild(document.createTextNode(data[-1]['oprema_ime']));
              img.setAttribute("src","img/oprema/"+data[data.length-1]['image']);
              img.setAttribute("class", 'image');
        }
            document.getElementById("left-"+id).appendChild(input);
            document.getElementById("left-"+id).appendChild(label);
            document.getElementById("left-"+id).appendChild(img);
      }
