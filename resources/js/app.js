import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

window.Alpine = Alpine;

Alpine.plugin(persist);

Alpine.store('cart', {
    items: Alpine.$persist([]).as('cart_items'),
    
    get subtotal() {
        return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },
    
    get total() {
        return this.subtotal;
    },
    
    addItem(menu, options, quantity, notes = '') {
        const itemId = this.generateItemId(menu.id, options);
        const existingItem = this.items.find(item => item.id === itemId);
        
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            this.items.push({
                id: itemId,
                menu_id: menu.id,
                name: menu.name,
                price: menu.price,
                image: menu.image,
                quantity: quantity,
                options: options,
                notes: notes
            });
        }

        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                menu_id: menu.id,
                quantity: quantity,
                options: options,
                notes: notes
            })
        }).catch(() => {});
    },
    
    updateQuantity(itemId, newQuantity) {
        const item = this.items.find(item => item.id === itemId);
        if (item) {
            item.quantity = newQuantity;
        }
    },
    
    removeItem(itemId) {
        this.items = this.items.filter(item => item.id !== itemId);
    },
    
    clearCart() {
        this.items = [];
    },
    
    generateItemId(menuId, options) {
        return `${menuId}-${JSON.stringify(options)}`;
    }
});

Alpine.store('productDetail', {
    open: false,
    menu: null,
    quantity: 1,
    notes: '',
    selectedOptions: {
        sugar: '50',
        ice: 'normal',
        temperature: 'hot'
    },
    sugarOptions: [],
    iceOptions: [],
    milkOptions: [],
    
    get totalPrice() {
        if (!this.menu) return 0;
        
        let price = parseFloat(this.menu.price);
        
        const milkOption = this.milkOptions.find(opt => opt.value === this.selectedOptions.milk)
            || this.milkOptions.find(opt => opt.name === this.selectedOptions.milk);
        if (milkOption && milkOption.extra_fee) {
            price += parseFloat(milkOption.extra_fee);
        }
        
        return price * this.quantity;
    },
    
    async showProduct(menuSlug) {
        try {
            const response = await fetch(`/menu/${menuSlug}`);
            const data = await response.json();
            
            this.menu = data;
            this.quantity = 1;
            this.notes = '';
            this.selectedOptions.temperature = 'hot';
            
            this.sugarOptions = data.options.filter(opt => opt.type === 'sugar');
            this.iceOptions = data.options.filter(opt => opt.type === 'ice');
            this.milkOptions = data.options.filter(opt => opt.type === 'milk');
            
            if (this.sugarOptions.length > 0) {
                this.selectedOptions.sugar = this.sugarOptions.find(opt => opt.value === '50')?.value || this.sugarOptions[0].value;
            }
            if (this.iceOptions.length > 0) {
                this.selectedOptions.ice = this.iceOptions.find(opt => opt.value === 'normal')?.value || this.iceOptions[0].value;
            }
            if (this.milkOptions.length > 0) {
                this.selectedOptions.milk = this.milkOptions.find(opt => opt.value === 'regular')?.value || this.milkOptions[0].value;
            }
            
            this.open = true;
        } catch (error) {
            console.error('Failed to load product:', error);
        }
    },
    
    calculatePrice() {
    },
    
    close() {
        this.open = false;
        setTimeout(() => {
            this.menu = null;
            this.quantity = 1;
            this.notes = '';
        }, 300);
    }
});

Alpine.start();