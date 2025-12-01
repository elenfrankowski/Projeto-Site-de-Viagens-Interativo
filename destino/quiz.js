// Variáveis
const question = document.querySelector('#question');
const answerBox = document.querySelector('#answers-box');
const quizzContainer = document.querySelector('#quizz-container');
const resultadoGeral = document.querySelector('#resultado-geral'); 
const letters = ['A','B','C','D'];
let actualQuestion = 0;
let A = 0; // Parques/Família
let B = 0; // Natureza
let C = 0; // Históricos
let D = 0; // Esportes

// =========================================================================================
// VARIÁVEIS PARA OS CARDS LATERAIS
const cardEsquerdoTitulo = document.querySelector('#card-esquerdo-titulo');
const cardEsquerdoDescricao = document.querySelector('#card-esquerdo-descricao');
const cardEsquerdoLink = document.querySelector('#card-esquerdo-link'); 

const cardDireitoTitulo = document.querySelector('#card-direito-titulo');
const cardDireitoDescricao = document.querySelector('#card-direito-descricao');
const cardDireitoLink = document.querySelector('#card-direito-link'); 
// =========================================================================================

// =========================================================================================
// Mapeamento Inverso (para converter nome completo salvo no PHP em letra A, B, C, D)
const perfilCompletoParaLetra = {
    'Parques/Família': 'A',
    'Natureza': 'B',
    'Histórico': 'C', 
    'Esportes': 'D',
    'Viajante Versátil': 'A' 
};
const perfilCompletoParaExibir = {
    'A': 'Parques/Família',
    'B': 'Natureza',
    'C': 'Histórico',
    'D': 'Esportes'
};
// =========================================================================================

// DADOS PARA OS CARDS (Mantido do código anterior)
const cardData = {
  'A': { // Parques/Família
        card1: { 
            titulo: 'Pacote Familiar: Parques',
            descricao: 'Um destino com diversão garantida para todas as idades, focado em lazer e família.',
            linkTexto: 'Ver Pacote: Aventura em Parques',
            linkURL: 'https://exemplo.com/pacote/familia-parques'
        },
        card2: { 
            titulo: 'Relax & Praia: Nacional',
            descricao: 'Seu perfil também curte a tranquilidade. Que tal um resort all inclusive?',
            linkTexto: 'Ver Pacote: Resorts Internacionais',
            linkURL: 'https://exemplo.com/pacote/nacional-resorts'
        }
    },
    'B': { // Natureza
        card1: {
            titulo: 'Ecoturismo e Aventura',
            descricao: 'Cachoeiras, trilhas e paisagens intocadas. Conecte-se com o meio ambiente.',
            linkTexto: 'Ver Pacote: Destinos Verdes',
            linkURL: 'https://exemplo.com/pacote/ecoturismo-trilhas'
        },
        card2: {
            titulo: 'Refúgio Tropical',
            descricao: 'Praias paradisíacas e tranquilas, perfeitas para meditar e descansar de verdade.',
            linkTexto: 'Ver Pacote: Praias Tropicais',
            linkURL: 'https://exemplo.com/pacote/tropical-praia'
        }
    },
    'C': { // Históricos
        card1: {
            titulo: 'História e Cultura Clássica',
            descricao: 'Viaje no tempo. Explore museus, sítios arqueológicos e cidades milenárias.',
            linkTexto: 'Ver Pacote: Cidades Históricas',
            linkURL: 'https://exemplo.com/pacote/historico-europa'
        },
        card2: {
            titulo: 'Culinária e Tradição',
            descricao: 'Uma viagem para descobrir os sabores e costumes de destinos com grande bagagem cultural.',
            linkTexto: 'Ver Pacote: Rota Gastronômica',
            linkURL: 'https://exemplo.com/pacote/gastronomia-cultural'
        }
    },
    'D': { // Esportes
        card1: {
            titulo: 'Adrenalina e Esportes',
            descricao: 'Seu destino deve ter atividades radicais, trilhas intensas ou esportes aquáticos.',
            linkTexto: 'Ver Pacote: Aventura Radical',
            linkURL: 'https://exemplo.com/pacote/esportes-radicais'
        },
        card2: {
            titulo: 'Metrópoles e Tendências',
            descricao: 'Grandes centros urbanos com foco em eventos esportivos, arquitetura moderna e movimento.',
            linkTexto: 'Ver Pacote: Cidades Modernas',
            linkURL: 'https://exemplo.com/pacote/metropoles-esportivas'
        }
    }
};

// Perguntas (Mantido do código anterior)
const questions = [
  {
    question: 'Qual tipo de viagem você prefere?',
    answers: [
      { answer: 'Nacional', perfil: 'A' },
      { answer: 'Internacional', perfil: 'C' },
      { answer: 'Inusitada/alternativa', perfil: 'D' },
      { answer: 'Relaxante e tropical', perfil: 'B' },
    ],
  },
  {
    question: 'Que clima você prefere para viajar?',
    answers: [
      { answer: 'Frio', perfil: 'C' },
      { answer: 'Quente', perfil: 'B' },
      { answer: 'Nenhum específico, me adapto', perfil: 'A' },
      { answer: 'Gosto de extremos', perfil: 'D' },
    ],
  },
  {
    question: 'Que tipo de experiência você busca?',
    answers: [
      { answer: 'História e cultura', perfil: 'C' },
      { answer: 'Aventura e natureza', perfil: 'B' },
      { answer: 'Modernidade e tendências', perfil: 'D' },
      { answer: 'Praia e descanso', perfil: 'A' },
    ],
  },
  {
    question: 'Qual paisagem mais te atrai?',
    answers: [
      { answer: 'Montanhas e cidades históricas', perfil: 'C' },
      { answer: 'Campos verdes e jardins', perfil: 'A' },
      { answer: 'Praias paradisíacas', perfil: 'B' },
      { answer: 'Cidades modernas e urbanas', perfil: 'D' },
    ],
  },
  {
    question: 'Qual ritmo de viagem você prefere?',
    answers: [
      { answer: 'Tranquilo e contemplativo', perfil: 'A' },
      { answer: 'Agitado e cheio de atividades', perfil: 'D' },
      { answer: 'Alternativo e diferente', perfil: 'B' },
      { answer: 'Mistura de descanso e aventura', perfil: 'C' },
    ],
  },
];

// Alterna exibição quiz/result (USAR APENAS NA TRANSIÇÃO DENTRO DO showSuccessMessage)
function hideOrShowQuizz(){quizzContainer.classList.toggle('hide');resultadoGeral.classList.toggle('hide');}

// Função para exibir a tela de resultado
function displayResults(bestProfile) {
    
    // Preenche os cards
    const cards = cardData[bestProfile];
    if (cards) { 
        cardEsquerdoTitulo.textContent = cards.card1.titulo;
        cardEsquerdoDescricao.textContent = cards.card1.descricao;
        cardEsquerdoLink.href = cards.card1.linkURL;
        cardEsquerdoLink.querySelector('.btn-pacote').textContent = cards.card1.linkTexto;

        cardDireitoTitulo.textContent = cards.card2.titulo;
        cardDireitoDescricao.textContent = cards.card2.descricao;
        cardDireitoLink.href = cards.card2.linkURL;
        cardDireitoLink.querySelector('.btn-pacote').textContent = cards.card2.linkTexto;
    }

    // Imagens dos cards
    const imagensPerfis = {
        'A': ['imagens/balneario.png', 'imagens/mexico.jpg'],
        'B': ['imagens/formiga.jpg', 'imagens/caribe.jpg'],
        'C': ['imagens/ruinas.jpg', 'imagens/franca.jpg'],
        'D': ['imagens/ceara.jpg', 'imagens/sydney.jpg']
    };
    document.querySelector('#imagem-esquerda').src = imagensPerfis[bestProfile][0];
    document.querySelector('#imagem-direita').src = imagensPerfis[bestProfile][1];
    
    // Atualiza a mensagem central
    const displayScoreSpan = document.querySelector('#display-score span');
    if (displayScoreSpan) {
        const perfilCompleto = perfilCompletoParaExibir[bestProfile] || 'Viajante Versátil';
        displayScoreSpan.textContent = `O seu perfil é: ${perfilCompleto}`;
    }
}


// Inicialização (CORREÇÃO CHAVE: DEFINE O ESTADO DA TELA)
function init(){
    
    // Verifica se a variável global 'resultadoSalvo' (injetada pelo PHP) existe e não está vazia.
    // Variável 'resultadoSalvo' é injetada em quiz.php: const resultadoSalvo = '<?php echo ... ?>';
    const resultadoExiste = typeof resultadoSalvo !== 'undefined' && resultadoSalvo;

    if (resultadoExiste) {
        
        // 1. SE HÁ RESULTADO SALVO: DEFINE O ESTADO PARA MOSTRAR RESULTADO
        quizzContainer.classList.add('hide');       // Oculta o Quiz
        resultadoGeral.classList.remove('hide');    // Exibe o Resultado
        
        const bestProfile = perfilCompletoParaLetra[resultadoSalvo] || 'A'; 
        displayResults(bestProfile);
        
        return; 
    }
    
    // 2. SE NÃO HOUVER RESULTADO: DEFINE O ESTADO PARA MOSTRAR QUIZ
    quizzContainer.classList.remove('hide'); // Exibe o Quiz
    resultadoGeral.classList.add('hide');    // Oculta o Resultado

    // Inicia o quiz normalmente
    createQuestion(0);
}


// Cria pergunta (Mantido)
function createQuestion(i){
  answerBox.innerHTML='';
  const questionText = question.querySelector('#question-text');
  const questionNumber = question.querySelector('#question-number');
  questionText.textContent=questions[i].question;
  questionNumber.textContent=i+1;

  questions[i].answers.forEach((answer,index)=>{
    const answerTemplate=document.querySelector('.answer-template').cloneNode(true);
    answerTemplate.querySelector('.btn-letter').textContent=letters[index];
    answerTemplate.querySelector('.question-answer').textContent=answer.answer;
    answerTemplate.setAttribute('data-perfil',answer.perfil);
    answerTemplate.classList.remove('hide'); 
    answerTemplate.classList.remove('answer-template');
    answerBox.appendChild(answerTemplate);
    answerTemplate.addEventListener('click',function(){checkAnswer(this);});
  });
  actualQuestion++;
}

// Verifica resposta (Mantido)
function checkAnswer(btn){
  const perfil=btn.getAttribute('data-perfil');
  switch(perfil){case 'A':A++;break;case 'B':B++;break;case 'C':C++;break;case 'D':D++;break;}
  nextQuestion();
}

// Próxima pergunta (Mantido)
function nextQuestion(){
  setTimeout(()=>{
    if(actualQuestion>=questions.length){showSuccessMessage();return;}
    createQuestion(actualQuestion);
  },300);
}

// Resultado final (CORRIGIDO: Faz a transição e submete o formulário)
function showSuccessMessage() {

    // 1. Calcula o perfil
    const scoreMap = { A, B, C, D };
    const sortedProfiles = Object.entries(scoreMap).sort(([, a], [, b]) => b - a);
    const bestProfile = sortedProfiles[0][0];

    // Mapeamento para o nome completo a ser salvo
    let perfilParaSalvar = '';
    if (bestProfile === 'A') {
        perfilParaSalvar = 'Parques/Família';
    } else if (bestProfile === 'B') {
        perfilParaSalvar = 'Natureza';
    } else if (bestProfile === 'C') {
        perfilParaSalvar = 'Histórico'; 
    } else if (bestProfile === 'D') {
        perfilParaSalvar = 'Esportes';
    } else {
        perfilParaSalvar = 'Viajante Versátil';
    }

    // 2. Faz a transição da tela do quiz para a tela de resultado
    hideOrShowQuizz(); 
    
    // 3. Preenche os cards na tela de resultado
    const displayScoreSpan = document.querySelector('#display-score span');
    if (displayScoreSpan) {
        displayScoreSpan.textContent = 'Calculámos o seu perfil! A guardar...';
    }
    displayResults(bestProfile); 

    // 4. Coloca este nome no formulário escondido
    const inputResultado = document.getElementById('perfil_resultado');
    if (inputResultado) {
        inputResultado.value = perfilParaSalvar;
    }

    // 5. Envia o formulário para o 'processa_quiz_js.php'
    // O PHP salva e *redireciona* para quiz.php, que será pego pelo init()
    const formResultado = document.getElementById('form-resultado');
    if (formResultado) {
        // Pequeno atraso para o usuário ver a transição e a mensagem "A guardar..."
        setTimeout(() => {
            formResultado.submit();
        }, 50); 
    }
}

// Reiniciar quiz (CORREÇÃO CHAVE: Redireciona para limpar a sessão)
document.querySelector('#restart').addEventListener('click', () => {
    // Redireciona para um script PHP (limpar_quiz.php) que deve:
    // 1. Remover $_SESSION['quiz']
    // 2. Redirecionar de volta para quiz.php
    window.location.href = 'limpar_quiz.php';
});

init();