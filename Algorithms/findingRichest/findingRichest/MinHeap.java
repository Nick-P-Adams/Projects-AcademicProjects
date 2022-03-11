package findingRichest;

public class MinHeap 
{
	private int[] heap;
	private int currentSize;
	private int maxSize;
	
	public MinHeap(int maxSize)
	{
		this.maxSize = maxSize;
		this.currentSize = 0;
		this.heap = new int[this.maxSize];
	}
	
	public void insert(int key)
	{
		if(this.currentSize >= this.maxSize)
		{
			return;
		}
		
		this.heap[this.currentSize] = key;
			
		int current = this.currentSize;
			
		while(this.heap[current] < this.heap[this.parent(current)])
		{
			this.swap(current, this.parent(current));
			current = this.parent(current);
		}
		this.currentSize++;
	}
	
	public int remove()
	{
		int removed = this.heap[0];
		
		this.heap[0] = this.heap[--this.currentSize];
		this.minHeapify(0);
		
		return removed;
	}
	
	public void minHeap()
	{
		for(int i = (this.currentSize - 1 / 2); i >= 1; i--)
		{
			this.minHeapify(i);
		}
	}
	
	private void minHeapify(int i)
	{
		int min = i;
		int right = this.rightChild(i);
		int left = this.leftChild(i);
		
		if(!(this.isLeaf(i)))
		{
			if(this.heap[i] > this.heap[left] || this.heap[i] > this.heap[right])
			{
				if(this.heap[left] < this.heap[right])
				{
					this.swap(i, left);
					this.minHeapify(left);
				}
				else
				{
					this.swap(i, right);
					this.minHeapify(right);
				}
			}
		}
	}
	
	public void heapSort()
	{
		for(int i = this.currentSize / 2 - 1; i >= 0; i--)
		{
			this.minHeapify(i);
		}
		
		for(int i = this.currentSize - 1; i >= 0; i --)
		{
			this.swap(0, i);
			this.minHeapify(i);
		}
	}
	
	private boolean isLeaf(int i) 
	{
		if(this.rightChild(i) >= this.currentSize || this.leftChild(i) >= this.currentSize)
		{
			return true;
		}
		return false;
	}
	
	private void swap(int a, int b)
	{
		int temp = this.heap[a];
		this.heap[a] = this.heap[b];
		this.heap[b] = temp;
	}
	private int parent(int i) {return ((i - 1)/2);}
	private int leftChild(int i) {return (i * 2 + 1);}
	private int rightChild(int i) {return (i * 2 + 2);}
	public int getSize() {return this.currentSize;}
	
	public void display()
	{
		for(int i = 0; i < this.currentSize; ++i)
		{
			System.out.print(this.heap[i] + " ");
		}
		System.out.println();
	}
	

}

