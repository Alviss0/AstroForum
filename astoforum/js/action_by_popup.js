const deleteUser = () => {
    const deleteFromId = document.querySelectorAll('.popup-delete-from');
    const deleteToId = document.querySelector('.popup-delete-to')
    if(deleteFromId && deleteToId) {
        const actionDeleteAddress = deleteToId.getAttribute('action');

        deleteFromId.forEach(link => {
            link.addEventListener('click', () => {
                let idToDelete = link.dataset.id;
                deleteToId.setAttribute('action', actionDeleteAddress + '?id=' + idToDelete);
            })
        })
    }
}
deleteUser();

const updateUserRole = () => {
    const updateFromId = document.querySelectorAll('.popup-update-from');
    const updateToId = document.querySelector('.popup-update-to')

    if(updateFromId && updateToId) {
        const actionUpdateAddress = updateToId.getAttribute('action');

        updateFromId.forEach(link => {
            link.addEventListener('click', () => {
                let idToUpdate = link.dataset.id;
                updateToId.setAttribute('action', actionUpdateAddress + '?id=' + idToUpdate);
            })
        })
    }

}
updateUserRole();

const insertCurrentTitle = () => {
    const updateFromTitle = document.querySelectorAll('.popup-update-from');
    const updateToTitle = document.querySelector('.popup-update-to-title');

    if(updateFromTitle && updateToTitle) {
        updateFromTitle.forEach(link => {
            link.addEventListener('click', () => {
                updateToTitle.setAttribute('value', link.dataset.title);
            })
        })
    }
}
insertCurrentTitle();

const insertCommentText = (comment) => {
    const commentTextTo = document.querySelector('#popup-update-comment textarea')
    if(comment && commentTextTo) {
        commentTextTo.innerHTML = comment.innerHTML;
    }
}

const insertArticleInfo = (title, content) => {
    const articleToTitle = document.querySelector('#article_title');
    const articleToContent = document.querySelector('#popup-update-article textarea');
    if(articleToTitle && articleToContent) {
        articleToTitle.value = title;
        articleToContent.innerHTML = content;
    }
}


