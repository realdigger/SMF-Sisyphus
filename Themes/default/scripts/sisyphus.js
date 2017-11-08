/**
 * @package SMF Sisyphus Mod
 * @author digger
 * @copyright 2011-2017
 * @license MIT
 * @version 2.0
 */

if ('localStorage' in window && window['localStorage'] !== null && typeof document.forms.postmodify != 'undefined') {

    // Load saved data if present
    if (localStorage.getItem(sisyphusKey) != null) document.forms.postmodify.message.value = localStorage.getItem(sisyphusKey);

    // Save data on every keyup
    document.forms.postmodify.message.addEventListener('input', sisyphusAdd);

    // Save data on every focus change
    document.forms.postmodify.message.addEventListener('focus', sisyphusAdd);

    // Remove data on submit
    if (typeof document.forms.postmodify.post != 'undefined')
        document.forms.postmodify.post.addEventListener('click', sisyphusRemove);
    else
        document.forms.postmodify.addEventListener('submit', sisyphusRemove);

    function sisyphusAdd() {
        if (document.forms.postmodify.message.value != '')
            localStorage.setItem(sisyphusKey, document.forms.postmodify.message.value)
        else sisyphusRemove();
    }

    function sisyphusRemove() {
        localStorage.removeItem(sisyphusKey);
    }

}
