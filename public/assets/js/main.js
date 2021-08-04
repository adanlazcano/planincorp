import { imgProfile, btnMenu } from './handlers/Elements.js';
import { toggleMenuHeader, toggleActive } from './handlers/Toggle.js';
import './handlers/RemoveClasses.js';

imgProfile.addEventListener('click', toggleMenuHeader);
btnMenu.addEventListener('click', toggleActive);