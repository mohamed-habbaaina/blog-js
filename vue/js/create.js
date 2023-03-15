console.log('hello');

const formCreateArticle = document.forms['formCreateArticle'],
    title = formCreateArticle['title'],
    category = formCreateArticle['category'],
    content = formCreateArticle['content'];

console.log(formCreateArticle, title, category, content);