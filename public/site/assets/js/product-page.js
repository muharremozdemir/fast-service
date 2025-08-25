document.querySelectorAll('.add-to-cart-button').forEach(button => {
    button.addEventListener('click', function () {
        const originalText = button.innerHTML;

        // Spinner ve butonu devre dışı bırakma
        button.disabled = true;
        button.innerHTML = 'Ekleniyor...';

        // 1 saniye sonra eski haline döndürme
        setTimeout(() => {
            button.insertAdjacentHTML('afterend', `
                <div class="cart-item-buttons">
                        <button class="btn cart-item-number-btn-left">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_15_1556)">
                                    <path d="M14.1667 5.00002H18.3334V6.66669H16.6667V17.5C16.6667 17.9603 16.2937 18.3334 15.8334 18.3334H4.16675C3.70651 18.3334 3.33341 17.9603 3.33341 17.5V6.66669H1.66675V5.00002H5.83341V2.50002C5.83341 2.03979 6.20651 1.66669 6.66675 1.66669H13.3334C13.7937 1.66669 14.1667 2.03979 14.1667 2.50002V5.00002ZM15.0001 6.66669H5.00008V16.6667H15.0001V6.66669ZM11.1786 11.6664L12.6517 13.1396L11.4732 14.3181L10.0001 12.8449L8.52691 14.3181L7.34843 13.1396L8.82158 11.6664L7.34843 10.1934L8.52691 9.01485L10.0001 10.4879L11.4732 9.01485L12.6517 10.1934L11.1786 11.6664ZM7.50008 3.33335V5.00002H12.5001V3.33335H7.50008Z" fill="#FE531F"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_15_1556">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                        <div class="cart-item-number">
                            <span>1</span>
                        </div>
                        <button class="btn cart-item-number-btn-right">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_15_1569)">
                                    <path d="M9.16675 9.16669V4.16669H10.8334V9.16669H15.8334V10.8334H10.8334V15.8334H9.16675V10.8334H4.16675V9.16669H9.16675Z" fill="#FE531F"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_15_1569">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>

                        </button>
                    </div>
            `);
            button.remove();
        }, 1000);
    });
});
