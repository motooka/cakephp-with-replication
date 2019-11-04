<?php
namespace App\Controller;

class ArticlesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
    
    public function index()
    {
        // use ReadReplica for this actoin
        $this->Articles->changeConnectionToReadReplica();
        
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
    
    public function tags()
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');
        
        // Use the ArticlesTable to find tagged articles.
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
        ]);
        
        // Pass variables into the view template context.
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }
    
    public function view($slug)
    {
        // use ReadReplica for this actoin
        $this->Articles->changeConnectionToReadReplica();
        
        $article = $this->Articles->findBySlug($slug)->contain(['Tags'])
            ->firstOrFail();
        $this->set(compact('article'));
    }
    
    public function add()
    {
        // if you call this here, an exception will be thrown on 'post' requests.
        // $this->Articles->changeConnectionToReadReplica();
        
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $article->user_id = 1;
            
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                
                // If data is replicated asynchronously, the inserted row sometimes does not appear on the redirect destination.
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        // Get a list of tags.
        $tags = $this->Articles->Tags->find('list');
        
        // Set tags to the view context
        $this->set('tags', $tags);
        
        $this->set('article', $article);
    }
    
    public function edit($slug)
    {
        $article = $this->Articles->findBySlug($slug)->contain(['Tags'])
            ->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
        
        // Get a list of tags.
        $tags = $this->Articles->Tags->find('list');
        
        // Set tags to the view context
        $this->set('tags', $tags);
        
        $this->set('article', $article);
    }
    
    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));
            return $this->redirect(['action' => 'index']);
        }
    }
}
