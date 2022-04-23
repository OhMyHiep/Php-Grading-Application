var nbrQuestion=1;

document.querySelector("#newquestion").addEventListener('click', newQuestion);

//Pre: user clicks new question
//Post: append new question into the webpage
function newQuestion(){
    const div=document.createElement("div");
    const textBox=makeInput(
        "question"+nbrQuestion,
        "question"+"["+nbrQuestion+"]","text");
    
    const textboxLabel=makeLabel(nbrQuestion+")",
        "question"+"["+nbrQuestion+"]");

    const choicesButton=makeButton("Add Choices","button"+nbrQuestion,"button");
    choicesButton.setAttribute("onClick", "javascript: addChoices(this);");
    const rubric=document.getElementById("rubric");
    const button= document.getElementById("submitRubric");
    const br=document.createElement("br");

    nbrQuestion=nbrQuestion+1;

    div.appendChild(textboxLabel);
    div.appendChild(textBox);
    div.appendChild(br);
    div.appendChild(choicesButton);
    rubric.insertBefore(div,button);
    
}

//Pre: need to make a button
//Post: make a button based on inputs
function makeButton(contentText,id,type){
    const button= document.createElement("button");
    button.setAttribute("type",type)
    button.setAttribute("id",id);
    button.textContent=contentText;
    return button;
}

//Pre: need to make a label
//Post: make a label based on inputs
function makeLabel(labelText,id){
    const lable=document.createElement("label");
    const lableText=document.createTextNode(labelText);
    lable.appendChild(lableText);
    lable.setAttribute("for",id);
    return lable;
}

//Pre: need to make a textbox
//Post: make a textbox based on inputs
function makeInput(id,name,type){
    const textBox=document.createElement("input");
    textBox.setAttribute("type",type);
    textBox.setAttribute("name",name);
    textBox.setAttribute("id",id);
    return textBox;
    
}

//Pre: user clicks add choice
//Post: add a choice below a question
function addChoices(button){
    const br=button.previousElementSibling;
    const temp=br.previousElementSibling;
    var chcText;
    var choice;
    var grade;
    if(temp.getAttribute("name").includes("question")){
        choice=initialChoice(temp.getAttribute("name"),"ans","text");
        grade=initialChoice(temp.getAttribute("name"),"grd","number");
        chcText="a)";
    }
    else{
        grade=subsequentChoice(temp.getAttribute("name"),"number");
        chcText=temp.previousElementSibling.previousElementSibling.previousElementSibling.textContent;
        chcText=nextChar(chcText)+")";
        const prevName=temp.previousElementSibling.previousElementSibling.getAttribute("name");
        choice=subsequentChoice(prevName,"text");
    }
    const chcLabel=makeLabel(chcText,choice.getAttribute("id"));
    const grdLabel=makeLabel("grade",grade.getAttribute("id"));
    const br2=document.createElement("br");

    grade.setAttribute("min",0);
    grade.setAttribute("max",100);

    button.parentNode.insertBefore(chcLabel,button);
    button.parentNode.insertBefore(choice,button);
    button.parentNode.insertBefore(grdLabel,button);
    button.parentNode.insertBefore(grade,button);
    button.parentNode.insertBefore(br2,button);
}

//Pre: need next character in alphabetical order
//Post: returns the next character in alphabet after input
function nextChar(c){
    return String.fromCharCode(c.charCodeAt(0) + 1);
}

//Pre:need to format the information of the first answer of a question
//Post: formats the information of the answer
function initialChoice(prevName,prefix,type){
    var name=""; 
    var id="";
    const num=getNum(prevName);
    name=prefix+"["+num+"]["+1+"]";
    id=prefix+num+","+1;
    console.log("name= "+name);
    console.log("id= "+id);
   return makeInput(id,name,type);
}

//Pre: need to format information of answers after the first answer of a question
//Post: formats the information of the answer
function subsequentChoice(prevName,type){
    var name=""; 
    var id="";
    const num=getNum(prevName);
    var tempName=prevName.substring(0,prevName.lastIndexOf("["));
    name=tempName+"["+(num+1)+"]";
    tempName=tempName.replace("[","");
    tempName=tempName.replace("]","");
    id=tempName+","+(num+1);
    console.log("name= "+name);
    console.log("id= "+id);
    return makeInput(id,name,type);
}

//Pre: need the number of within the name 
//Post: returns the number as an int
function getNum(prevName){
    const low=prevName.lastIndexOf("[");
    const high=prevName.lastIndexOf("]");
    return parseInt(prevName.substring(low+1,high));
}



