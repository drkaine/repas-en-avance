export function ouvertureModal() {
    const modal = document.querySelector('.modal') as HTMLDivElement;
    modal.style.display = 'block';
  
    document.addEventListener('click', fermetureModalHorsDuContenu);
  }
  
  export function fermetureModal() {
    const modal = document.querySelector('.modal') as HTMLDivElement;
    modal.style.display = 'none';
  
    document.removeEventListener('click', fermetureModalHorsDuContenu);
  }
  
  function fermetureModalHorsDuContenu(event: MouseEvent) {
    const modal = document.querySelector('.modal') as HTMLDivElement;
    const modalContent = modal.querySelector('.contenu-modal') as HTMLDivElement;
  
    if (!modalContent.contains(event.target as Node)) {
        fermetureModal();
    }
  }