# Javascript


## Parse JSON 
```
<script>
let text = '{"employees":[' +
'{"firstName":"John","lastName":"Doe" },' +
'{"firstName":"Anna","lastName":"Smith" },' +
'{"firstName":"Peter","lastName":"Jones" }]}';

const obj = JSON.parse(text);
document.getElementById("demo").innerHTML =
obj.employees[1].firstName + " " + obj.employees[1].lastName;
</script>
```


```
let url = 'https://example.com';

fetch(url)
.then(res => res.json())
.then((out) => {
  console.log('Checkout this JSON! ', out);
})
.catch(err => { throw err });
```

```
fetch('https://api.chucknorris.io/jokes/random?category=dev')
  .then(res => res.json()) // the .json() method parses the JSON response into a JS object literal
  .then(data => console.log(data));
```


## Send Request Post

```
$.ajax({
  type: "POST",
  url: "https://reqbin.com/echo/post/json",
  data: `{
    "Id": 78912,
    "Customer": "Jason Sweet",
    "Quantity": 1,
    "Price": 18.00
  }`,
  success: function () {
    if (xhr.readyState === 4) {
      console.log(xhr.status);
      console.log(xhr.responseText);
  }},
  dataType: "json"
});
```
## Get Request 

```
var url = get_server();
    $.getJSON(url,function(data){
         var address =data.address;
         var town =data.town;
         var status =data.status;
         var name =data.name;
         var zip =data.zip;
         var phonenumber =data.phone;
         var maxnumber = data.max_number;

        
         if (status == "yes") {
            
             window.localStorage.setItem("phone", getPhone(phone));
             document.getElementById("address").value = address;
             document.getElementById("town").value = town;
             document.getElementById("name").value = name;
             document.getElementById("phone").value = setPhone(phonenumber.replace(/\s/g, ''));
             document.getElementById("zip").value = zip;
             document.getElementById("maxnumber").value = maxnumber;
             document.getElementById("waiting").style.display="none";
             document.getElementById("rowUpdate").style.display="block";
       
         }
        else {
        alert(getMatch(message));
        }
         });

```
## LocalStorage get and set Item



```
 window.localStorage.setItem("loggedin", "1");
 window.localStorage.getItem("loggedin");
 ```
 
 
 Source 1 :
 
 https://reqbin.com/req/javascript/uzf79ewc/javascript-post-request-example
 
 https://stackoverflow.com/questions/8207488/get-all-variables-sent-with-post
 
 https://developer.okta.com/blog/2021/08/02/fix-common-problems-cors
 
 https://stackoverflow.com/questions/31473420/make-an-http-post-authentication-basic-request-using-javascript
 
 https://stackoverflow.com/questions/22087076/how-to-make-a-simple-image-upload-using-javascript-html
 
 https://stackoverflow.com/questions/6150289/how-can-i-convert-an-image-into-base64-string-using-javascript
 
 
 
 
 
 