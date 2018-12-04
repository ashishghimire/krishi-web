/**
 * This class represents a dialog message overlaying a DOM element in order to
 * accept / cancel discard changes. The dialog can be closed i.e the overlay disappears
 * o canceled. In this last case a callback function should be called.
 */
export default class PopUpMessage {

    /**
     *
     * @param {Object} popupMessageAttributes - Object containing popup properties.
     * @param {HTMLElement} popupMessageAttributes.overlayElement - Element to overlay.
     * @param {Object} popupMessageAttributes.callbacks - contains callback methods for close and cancel actions.
     * @param {Object} popupMessageAttributes.strings - contains all the strings needed.
     */
    constructor(popupMessageAttributes) {


        /**
         * Element to be overlaid when the popup appears.
         */
        this.overlayElement = popupMessageAttributes.overlayElement;

        this.callbacks = popupMessageAttributes.callbacks;


        /**
         * HTMLElement element to wrap all HTML elements inside the popupMessage.
         */
        this.overlayWrapper = this.overlayElement.appendChild(document.createElement("div"));
        this.overlayWrapper.setAttribute("class", "wrs_popupmessage_overlay_envolture");

        /**
         * HTMLElement to display the popup message, close button and cancel button.
         */
        this.message = this.overlayWrapper.appendChild(document.createElement("div"));
        this.message.id = "wrs_popupmessage"
        this.message.setAttribute("class", "wrs_popupmessage_panel");
        this.message.innerHTML = popupMessageAttributes.strings.message;

        /**
         * HTML element overlaying the overlayElement.
         */
        var overlay = this.overlayWrapper.appendChild(document.createElement("div"));
        overlay.setAttribute("class", "wrs_popupmessage_overlay");
        // We create a overlay that close popup message on click in there
        overlay.addEventListener("click", this.cancelAction.bind(this));

        /**
         * HTML element containing cancel and close buttons.
         */
        this.buttonArea = this.message.appendChild(document.createElement('div'));
        this.buttonArea.setAttribute("class", "wrs_popupmessage_button_area");
        this.buttonArea.id = 'wrs_popup_button_area';

        // Close button arguments.
        var buttonSubmitArguments = {
            class: "wrs_button_accept",
            innerHTML: popupMessageAttributes.strings.submitString,
            id: 'wrs_popup_accept_button'
        };

        /**
         * Close button arguments.
         */
        this.closeButton = this.createButton(buttonSubmitArguments, this.closeAction.bind(this));
        this.buttonArea.appendChild(this.closeButton);

        // Cancel button arguments.
        var buttonCancelArguments = {
            class: "wrs_button_cancel",
            innerHTML: popupMessageAttributes.strings.cancelString,
            id: 'wrs_popup_cancel_button'
        };

        /**
         * Cancel button.
         */
        this.cancelButton = this.createButton(buttonCancelArguments, this.cancelAction.bind(this));
        this.buttonArea.appendChild(this.cancelButton);
    }

    /**
     * This method create a button with arguments and return button dom object
     * @param {Object} parameters - An object containing id, class and innerHTML button text.
     * @param {string} parameters.id - button id.
     * @param {string} parameters.class - button class name.
     * @param {string} parameters.innerHTML - button innerHTML text.
     * @param {object} callback- callback method to call on click event.
     * @returns {HTMLElement} HTML button.
     */
    createButton(parameters, callback) {
        var element = {};
        element = document.createElement("button");
        element.setAttribute("id", parameters.id);
        element.setAttribute("class", parameters.class);
        element.innerHTML = parameters.innerHTML;
        element.addEventListener("click", callback);

        return element;
    }

    /**
     * Shows the popupmessage containing a message, and two buttons
     * to cancel the action or close the modal dialog.
     */
    show() {
        if (this.overlayWrapper.style.display != 'block') {
            // Clear focus with blur for prevent press any key.
            document.activeElement.blur();

            // For works with Safari
            window.focus();
            this.overlayWrapper.style.display = 'block';
        }
        else {
            this.overlayWrapper.style.display = 'none';
            _wrs_modalWindow.focus();
        }
    }

    /**
     * This method cancels the popupMessage: the dialog disappears revealing the overlaid element.
     * A callback method is called (if defined). For example a method to focus the overlaid element.
     */
    cancelAction() {
        this.overlayWrapper.style.display = 'none';
        if (typeof this.callbacks.cancelCallback !== 'undefined') {
            this.callbacks.cancelCallback();
        }
    }

    /**
     * This method closes the popupMessage: the dialog disappears and the close callback is called.
     * For example to close the overlaid element.
     */
    closeAction() {
        this.cancelAction();
        if (typeof this.callbacks.closeCallback !== 'undefined') {
            this.callbacks.closeCallback();
        }
    }
}