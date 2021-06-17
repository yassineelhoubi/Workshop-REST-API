document.getElementById('getMessage').addEventListener('click',read);
function read(){
    fetch('api/posts/read.php')
    .then(res => res.json())
    .then(data => {
        let output = '';
        for(i in data['data']){
            output +=`<ul class="blog">
              
                          <li>post N° : ${i}</li>
                          <li>id : ${data['data'][i].id}</li>
                          <li>title : ${data['data'][i].title}</li>
                          <li>body : ${data['data'][i].body}</li>
                          <li>author : ${data['data'][i].author}</li>
                          <li>category name : ${data['data'][i].category_name}</li>
                          <li>category id : ${data['data'][i].category_id}</li>
                      </ul>`
                      
        }
        
        document.querySelector('.responseText').innerHTML = output
        

    })
}

document.getElementById('postMessage').addEventListener('click' , addPost)
function addPost(e){
    e.preventDefault();
    let title = document.getElementById('title').value
    let body = document.getElementById('body').value
    let author = document.getElementById('author').value
    let category_id = document.getElementById('category_id').value
    fetch('api/posts/create.php',{
        method: 'post',
        body: JSON.stringify({
                title: title,
                body: body,
                author: author,
                category_id: category_id
        })

    })

    .then(res => res.json())
    .then(data => console.log(data))
    read()
}

document.getElementById('updateMessage').addEventListener('click',update);
function update(e){
    e.preventDefault();
    let id  = document.getElementById('idpost-u').value
    let title = document.getElementById('title-u').value
    let body = document.getElementById('body-u').value
    let author = document.getElementById('author-u').value
    let category_id = document.getElementById('category_id-u').value
    fetch('api/posts/update.php',{
        method: 'PUT',
        body: JSON.stringify({
            id: id,
            title: title,
            body: body,
            author:author,
            category_id:category_id
        })
    })
    .then(res => res.json())
    .then(data => console.log(data))
    read()
}
document.getElementById('deleteMessage').addEventListener('click',deletePost);
function deletePost(e){
    e.preventDefault()
    let id  = document.getElementById('idpost-d').value
    fetch('api/posts/delete.php',{
        method: 'DELETE',
        body: JSON.stringify({
            id: id
        })
        
    })
    .then(res => res.json())
    .then(data => console.log(data))
    read()

}
