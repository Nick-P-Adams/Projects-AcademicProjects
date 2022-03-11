public class Node 
{
	private String data;
	private Node prev, next;
	
	public Node(String data, Node prev, Node next)
	{
		this.data = data;
		this.prev = prev;
		this.next = next;
	}
	
	public void setData(String data){this.data = data;}
	public void setPrev(Node prev){this.prev = prev;}
	public void setNext(Node next){this.next = next;}
	public String getData(){return this.data;}
	public Node getPrev(){return this.prev;}
	public Node getNext(){return this.next;}
}
