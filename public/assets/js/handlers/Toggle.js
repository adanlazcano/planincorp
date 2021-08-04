import { imgProfile, menuNavigation } from './Elements.js';

export const toggleMenuHeader = e => {
    e.stopPropagation();
    e.target.classList.toggle('active');
    menuNavigation.classList.remove('active');
}

export const toggleActive = e => {

    e.stopPropagation();
    menuNavigation.classList.toggle('active');
    imgProfile.classList.remove('active');

}