<div x-show="showIndigencyModal" style="display: none" 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"  
     @click.away="showIndigencyModal = false"
     x-data="{ 
         zoom: 1, 
         isDragging: false, 
         dragStartX: 0, 
         dragStartY: 0, 
         posX: 0, 
         posY: 0,
         startDrag(event) {
             this.isDragging = true;
             this.dragStartX = event.clientX - this.posX;
             this.dragStartY = event.clientY - this.posY;
         },
         onDrag(event) {
             if (this.isDragging) {
                 this.posX = event.clientX - this.dragStartX;
                 this.posY = event.clientY - this.dragStartY;
             }
         },
         endDrag() {
             this.isDragging = false;
         }
     }" 
     @mousemove="onDrag($event)" 
     @mouseup="endDrag" 
     @mouseleave="endDrag"> 

    <div @click.stop class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-3xl w-full relative">
        <section class="p-4 bg-gray-50 dark:bg-gray-900">

            <button type="button" @click="showIndigencyModal = false" 
                    class="absolute top-4 right-4 z-40 focus:outline-none">
                <img src="images/close.png" alt="Close" class="h-6 w-6">
            </button>

            <div class="flex justify-center p-6">
                <img :src="indigencyPreviewUrl" alt="Enlarged Indigency Preview" 
                    class="max-h-[600px] rounded-md shadow-lg" 
                    :style="{ 
                        transform: `scale(${zoom}) translate(${posX}px, ${posY}px)`, 
                        transition: 'transform 0.2s ease', 
                        cursor: isDragging ? 'grabbing' : 'grab'
                    }"
                    @mousedown="startDrag($event)" 
                    @mouseup="endDrag" 
                    @mouseleave="endDrag"
                    @dragstart.prevent> 
            </div>
        </section>

        <div class="absolute bottom-0 left-0 right-0 flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-900 z-40"> 
            <button type="button" @click="zoom = zoom < 2 ? zoom + 0.1 : zoom" 
                    class="hover:animate-scale px-2 py-1 bg-gray-300 hover:bg-gray-400 rounded">Zoom In</button>
            <button type="button" @click="zoom = zoom > 1 ? zoom - 0.1 : zoom" 
                    class="hover:animate-scale px-2 py-1 bg-gray-300 hover:bg-gray-400 rounded">Zoom Out</button>
        </div>
    </div>
</div>
